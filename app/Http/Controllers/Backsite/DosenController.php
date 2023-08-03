<?php

namespace App\Http\Controllers\Backsite;

// Default
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Request
use App\Http\Requests\Dosen\StoreDosen;
use App\Http\Requests\Dosen\UpdateDosen;

// Everything Else
use Auth;
use Gate;
use File;

// Model
use App\Models\Operational\Dosen;
use App\Models\MasterData\Position;
use App\Models\User;

// Third Party

class DosenController extends Controller
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
    public function index()
    {
        // Middleware Gate
        abort_if(Gate::denies('dosen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosen = Dosen::orderBy('created_at', 'desc')->get();
        $position = Position::orderBy('name', 'asc')->get();
        $user = User::whereHas('detail_user', function($query){
            $query->where('type_user_id', 2);
        })->orderBy('name', 'asc')->get();

        return view('pages.operational.dosen.index', compact('dosen', 'position', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDosen $request)
    {
        // Ambil semua data dari frontsite
        $data = $request->all();

        // upload process here
        $path = public_path('app/public/assets/file-dosen');
        if(!File::isDirectory($path)){
            $response = Storage::makeDirectory('public/assets/file-dosen');
        }

        // change file locations
        if(isset($data['photo'])){
            $data['photo'] = $request->file('photo')->store(
                'assets/file-dosen', 'public'
            );
        }else{
            $data['photo'] = "";
        }

        // dd($data['photo']);

        // Kirim data ke database
        $dosen = Dosen::create($data);

        // Sweetalert
        alert()->success('Success Create Message', 'Successfully added new Dosen');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.dosen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.operational.dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Ditampilkan pada form sebagai pilihan
        $position = Position::orderBy('name', 'asc')->get();
        $user = User::whereHas('detail_user', function($query){
            $query->where('type_user_id', 2);
        })->orderBy('name', 'asc')->get();

        return view('pages.operational.dosen.edit', compact('dosen', 'position', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDosen $request, Dosen $dosen)
    {
        // Ambil semua data dari frontsite
        $data = $request->all();

        // upload process here
        // change format photo
        if(isset($data['photo'])){

             // first checking old photo to delete from storage
            $get_item = $dosen['photo'];

            // change file locations
            $data['photo'] = $request->file('photo')->store(
                'assets/file-dosen', 'public'
            );

            // delete old photo from storage
            $data_old = 'storage/'.$get_item;
            if (File::exists($data_old)) {
                File::delete($data_old);
            }else{
                File::delete('storage/app/public/'.$get_item);
            }

        }

        // Update data ke database
        $dosen->update($data);

        // Sweetalert
        alert()->success('Success Update Message', 'Successfully updated Dosen');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.dosen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // first checking old file to delete from storage
        $get_item = $dosen['photo'];

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        $dosen->delete();

        // Sweetalert
        alert()->success('Success Delete Message', 'Successfully deleted Dosen');
        // Tempat akan ditampilkannya Sweetalert
        return back();
    }
}
