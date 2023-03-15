<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageFormRequest;
use App\Models\Message;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $slot = 123;
        return view('chat.index', compact('slot'));
    }

    public function messages(): Collection|array
    {
        return Message::with('user')->get();
    }

    public function send(MessageFormRequest $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($request->user(),$message));

        return ['status' => 'Message Sent!'];
    }

}
