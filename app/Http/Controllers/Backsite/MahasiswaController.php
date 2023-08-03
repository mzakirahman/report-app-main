<?php

namespace App\Http\Controllers\Backsite;

// Default
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Request
use App\Http\Requests\Mahasiswa\StoreMahasiswa;
use App\Http\Requests\Mahasiswa\UpdateMahasiswa;

// Everything Else
use Auth;
use Gate;
use File;

// Model
use App\Models\Operational\Mahasiswa;
use App\Models\User;
use App\Models\MasterData\Kelas;

// Third Party

class MahasiswaController extends Controller
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
        abort_if(Gate::denies('mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa = Mahasiswa::orderBy('created_at', 'desc')->get();
        // Ditampilkan pada form sebagai pilihan
        $kelas = Kelas::orderBy('name', 'asc')->get();
        $user = User::whereHas('detail_user', function($query){
            $query->where('type_user_id', 3);
        })->orderBy('name', 'asc')->get();

        return view('pages.operational.mahasiswa.index', compact('mahasiswa', 'kelas', 'user'));
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
    public function store(StoreMahasiswa $request)
    {
        // Ambil semua data dari frontsite
        $data = $request->all();

        // upload process here
        $path = public_path('app/public/assets/file-mahasiswa');
        if(!File::isDirectory($path)){
            $response = Storage::makeDirectory('public/assets/file-mahasiswa');
        }

        // change file locations
        if(isset($data['photo'])){
            $data['photo'] = $request->file('photo')->store(
                'assets/file-mahasiswa', 'public'
            );
        }else{
            $data['photo'] = "";
        }

        // Kirim data ke database
        $mahasiswa = Mahasiswa::create($data);

        // Sweetalert
        alert()->success('Success Create Message', 'Successfully added new Mahasiswa');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.mahasiswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.operational.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Ditampilkan pada form sebagai pilihan
        $kelas = Kelas::orderBy('name', 'asc')->get();
        $user = User::whereHas('detail_user', function($query){
            $query->where('type_user_id', 3);
        })->orderBy('name', 'asc')->get();

        return view('pages.operational.mahasiswa.edit', compact('mahasiswa', 'kelas', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswa $request, Mahasiswa $mahasiswa)
    {
        // Ambil semua data dari frontsite
        $data = $request->all();

        // upload process here
        // change format photo
        if(isset($data['photo'])){

             // first checking old photo to delete from storage
            $get_item = $mahasiswa['photo'];

            // change file locations
            $data['photo'] = $request->file('photo')->store(
                'assets/file-mahasiswa', 'public'
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
        $mahasiswa->update($data);

        // Sweetalert
        alert()->success('Success Update Message', 'Successfully updated Mahasiswa');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // first checking old file to delete from storage
        $get_item = $mahasiswa['photo'];

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        $mahasiswa->delete(); 

        // Sweetalert
        alert()->success('Success Delete Message', 'Successfully deleted Mahasiswa');
        // Tempat akan ditampilkannya Sweetalert
        return back();
    }
}
