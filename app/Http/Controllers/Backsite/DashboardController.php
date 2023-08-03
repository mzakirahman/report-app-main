<?php

namespace App\Http\Controllers\Backsite;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Operational\Dosen;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Operational\Chat;
use App\Models\Operational\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $user = Auth::user();
        $chat = null;

        if ($user->role_user->contains('role_id', 6)) {
            $chat = Chat::where('user_id', $user->id)->get();
        } elseif ($user->role_user->contains('role_id', 5)) {
            $chat = Chat::where('dosen_id', $user->dosen->id)->get();
        } else {
            $chat = Chat::all();
        }

        $user =  User::all();
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view('pages.dashboard.index', compact('user', 'dosen', 'results', 'mahasiswa', 'chat'));
    }
}
