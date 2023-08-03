<?php

namespace App\Http\Controllers\Backsite;

// Default
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Everything Else
use Auth;
use Gate;

// Model
use App\Models\MasterData\Kelas;

// Third Party

class KelasController extends Controller
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
        abort_if(Gate::denies('kelas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kelas = Kelas::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.kelas.index', compact('kelas'));
    }
}
