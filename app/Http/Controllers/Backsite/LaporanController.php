<?php

namespace App\Http\Controllers\Backsite;

// Default
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Library
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

// Request
use App\Http\Requests\Laporan\StoreLaporan;
use App\Http\Requests\Laporan\UpdateLaporan;

// Everything Else
use Auth;
use Gate;
use File;
use PDF;

// Model
use App\Models\Operational\Dosen;
use App\Models\MasterData\Kelas;
use App\Models\Operational\Laporan;
use App\Models\User;

// Third Party

class LaporanController extends Controller
{
    // Middleware Auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Middleware Gate
        abort_if(Gate::denies('laporan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laporans = DB::table('laporan')
            ->select(DB::raw('MIN(id) as id'))
            ->groupBy('created_at')
            ->get();

        $results = [];

        foreach ($laporans as $laporan) {
            $result = DB::table('laporan')
                ->join('kelas', 'laporan.kelas_id', '=', 'kelas.id')
                ->join('dosen', 'laporan.dosen_id', '=', 'dosen.id')
                ->select('laporan.*', 'kelas.name as kelas_name', 'dosen.name as dosen_name')
                ->where('laporan.id', '=', $laporan->id)
                ->first();

            array_push($results, $result);
        }

        $dosen = Dosen::orderBy('name', 'asc')->get();
        $kelas = Kelas::orderBy('name', 'asc')->get();

        return view('pages.operational.laporan.index', compact('results', 'dosen', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate input
        $validator = Validator::make($request->all(), [
            'dosen_id' => 'required|exists:dosen,id',
            'kelas_id' => 'required|exists:kelas,id',
            'agenda.*' => 'required',
            'deskripsi.*' => 'required',
            'tindakan.*' => 'required',
            'lampiran.*' => 'nullable', 'file|mimes:jpg,jpeg,png,svg|max:10000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if($request->agenda){
            foreach ($request->agenda as $key => $value) {
                $lampiran = null;
                if ($request->hasFile('lampiran.' . $key)) {
                    $lampiran = $request->file('lampiran.' . $key)->store('assets/file-laporan', 'public');
                }
                $data = [
                    'dosen_id' => $request->dosen_id,
                    'kelas_id' => $request->kelas_id,
                    'agenda' => $request->agenda[$key],
                    'deskripsi' => $request->deskripsi[$key],
                    'tindakan' => $request->tindakan[$key],
                    'lampiran' => $lampiran,
                    'status_dosen' => 2,
                    'status_kaprodi' => 2,
                    'status_kajur' => 2,
                    'status_wadir' => 2
                ];
                Laporan::create($data);
            }
        }

        // Sweetalert
        alert()->success('Success Create Message', 'Successfully added new Laporan');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.laporan.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        abort_if(Gate::denies('laporan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($laporan->id);

        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        return view('pages.operational.laporan.show', compact('laporanGroups', 'laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        abort_if(Gate::denies('laporan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($laporan->id);
        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        $kelas = Kelas::orderBy('name', 'asc')->get();
        $dosen = Dosen::orderBy('name', 'asc')->get();
        $laporans = Laporan::all();

        return view('pages.operational.laporan.edit', compact('laporan', 'laporanGroups', 'kelas', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        $laporans = Laporan::where('created_at', $laporan->created_at)->get();
        foreach ($laporans as $key => $laporan) {
            $dosen_id = $request->input('dosen_id');
            $kelas_id = $request->input('kelas_id');
            $agenda = $request->input('agenda.' . $key);
            $deskripsi = $request->input('deskripsi.' . $key);
            $tindakan = $request->input('tindakan.' . $key);
            $lampiranPath = null;

            $laporan->dosen_id = $dosen_id;
            $laporan->kelas_id = $kelas_id;
            $laporan->agenda = $agenda;
            $laporan->deskripsi = $deskripsi;
            $laporan->tindakan = $tindakan;

            if ($request->hasFile('lampiran.' . $key)) {
                $lampiran = $request->file('lampiran.' . $key);
                $lampiranPath = $lampiran->store('assets/file-laporan', 'public');
                $laporan->lampiran = $lampiranPath;
            }
            dd($laporan);

            $laporan->save();
        }
        alert()->success('Success Update Message', 'Successfully updated Laporan');
        return redirect()->route('backsite.laporan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Laporan $laporan)
    {
        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($laporan->id);
        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        foreach ($laporanGroups as $laporanGroup) {
            $laporanGroup->each(function ($laporan) {
                $laporan->delete();
            });
        }

        // Sweetalert
        alert()->success('Success Delete Message', 'Successfully deleted Laporan');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.laporan.index');
    }

    public function pdf(Laporan $laporan)
    {
        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($laporan->id);
        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        $data = [
            'laporan' => $laporan,
            'laporanGroups' => $laporanGroups,
        ];

        $pdf = \PDF::loadView('pages.operational.laporan.pdf', $data)->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function status_kaprodi(Request $request, $id)
    {
        // Update status value
        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($id);
        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        $status = $request->input('pilihan');
        foreach ($laporanGroups as $laporanGroup) {
            $laporanGroup->each(function ($laporan) use ($status) {
                if($status == 'Terima'){
                    $laporan->status_kaprodi = 1;
                } elseif($status == 'Revisi'){
                    $laporan->status_kaprodi = 3;
                }
                $laporan->save();
            });
        }
        // Sweetalert
        alert()->success('Success Update Message', 'Successfully updated Laporan');

        // Redirect to index page
        return redirect()->route('backsite.laporan.index');
    }

    public function status_kajur(Request $request, $id)
    {
        // Update status value
        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($id);
        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        $status = $request->input('pilihan');
        foreach ($laporanGroups as $laporanGroup) {
            $laporanGroup->each(function ($laporan) use ($status) {
                if($status == 'Terima'){
                    $laporan->status_kajur = 1;
                } elseif($status == 'Revisi'){
                    $laporan->status_kajur = 3;
                }
                $laporan->save();
            });
        }
        // Sweetalert
        alert()->success('Success Update Message', 'Successfully updated Laporan');

        // Redirect to index page
        return redirect()->route('backsite.laporan.index');
    }

    public function revisi(Laporan $laporan)
    {
        abort_if(Gate::denies('laporan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laporan = Laporan::with('kelas', 'dosen')->findOrFail($laporan->id);
        $laporanGroups = Laporan::with('kelas', 'dosen')
            ->where('created_at', $laporan->created_at)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('created_at');

        $kelas = Kelas::orderBy('name', 'asc')->get();
        $dosen = Dosen::orderBy('name', 'asc')->get();
        $laporans = Laporan::all();

        return view('pages.operational.laporan.revisi', compact('laporan', 'laporanGroups', 'kelas', 'dosen'));
    }

    public function confirm_revisi(Request $request, Laporan $laporan)
    {
        $laporans = Laporan::where('created_at', $laporan->created_at)->get();
        foreach ($laporans as $key => $laporan) {
            $dosen_id = $request->input('dosen_id');
            $kelas_id = $request->input('kelas_id');
            $agenda = $request->input('agenda.' . $key);
            $deskripsi = $request->input('deskripsi.' . $key);
            $tindakan = $request->input('tindakan.' . $key);
            $status = null;
            $lampiranPath = null;

            $laporan->dosen_id = $dosen_id;
            $laporan->kelas_id = $kelas_id;
            $laporan->agenda = $agenda;
            $laporan->deskripsi = $deskripsi;
            $laporan->tindakan = $tindakan;
            $laporan->status_dosen = 4;

            if ($request->hasFile('lampiran.' . $key)) {
                $lampiran = $request->file('lampiran.' . $key);
                $lampiranPath = $lampiran->store('assets/file-laporan', 'public');
                $laporan->lampiran = $lampiranPath;
            }

            $laporan->save();
        }
        alert()->success('Success Update Message', 'Successfully updated Laporan');

        return redirect()->route('backsite.laporan.index');
    }
}
