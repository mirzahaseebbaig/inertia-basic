<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ChatsController extends Controller
{
    public function index()
    {
        return Inertia::render('chat');
    }
}
