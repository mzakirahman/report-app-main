<?php

namespace App\Http\Controllers\Backsite;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MasterData\Kelas;
use App\Models\Operational\Chat;
use App\Models\Operational\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
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
        $user = Auth::user();
        $chat = null;

        if ($user->role_user->contains('role_id', 6)) {
            $chat = Chat::where('user_id', $user->id)->get();
        } elseif ($user->role_user->contains('role_id', 5)) {
            $chat = Chat::where('dosen_id', $user->dosen->id)->get();
        } else {
            $chat = Chat::all();
        }

        $dosen = Dosen::all();
        $kelas = Kelas::all();

        return view('pages.operational.chat.index', compact('chat', 'dosen', 'kelas', 'user'));
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
    public function store(Request $request)
    {
        $chat = new Chat;
        $chat->user_id = auth()->user()->id;
        $chat->dosen_id = $request['dosen_id'];
        $chat->kelas_id = $request['kelas_id'];
        $chat->deskripsi = $request['deskripsi'];
        $chat->pesan = $request['pesan'];
        $chat->balasan = $request['balasan'];
        $chat->status = 1;
        $chat->save();

        // Sweetalert
        alert()->success('Success Create Message', 'Successfully added new Chat');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.chat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        abort_if(Gate::denies('chat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.operational.chat.show', compact('chat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chat = Chat::findOrFail($id);

        // Assuming you have methods to fetch $dosen and $kelas data
        $dosen = Dosen::all();
        $kelas = Kelas::all();

        return view('pages.operational.chat.edit', compact('chat', 'dosen', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        $request->validate([
            'balasan' => 'required',
        ]);

        if (!$request->user()->can('chat_balasan')) {
            abort(403, 'Unauthorized action.');
        }

        $chat->update([
            'balasan' => $request->input('balasan'),
            'status' => 2
        ]);

        // Sweetalert
        alert()->success('Success Create Message', 'Successfully edit Chat');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.chat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();

        // Sweetalert
        alert()->success('Success Create Message', 'Successfully delete Chat');
        // Tempat akan ditampilkannya Sweetalert
        return redirect()->route('backsite.chat.index');
    }
}
