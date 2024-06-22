<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatsController extends Controller
{
    //Add the below functions

    public function index()
    {
        $users = User::whereNotLoggedIn();

        return Inertia::render('chat', compact('users'));
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message'),
        ]);

        return ['status' => 'Message Sent!'];
    }
}
