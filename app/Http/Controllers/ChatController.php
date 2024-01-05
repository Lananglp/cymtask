<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $chat = Chat::with('user')->get();

        return view('chat.index', compact('chat'));
    }

    public function store(Request $request)
    {
        $login_id = auth()->user()->id;
        $chat = new Chat;
        $chat->user_id = $login_id;
        $chat->chat = $request->input('chat');
        $chat->save();

        return redirect()->back()->with('success', 'Pesan terkirim.');
    }
}
