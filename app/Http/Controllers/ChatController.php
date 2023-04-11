<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageFormRequest;
use App\Models\Message;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Inertia\Response;
use Inertia\ResponseFactory;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Response|ResponseFactory
    {
        $user = auth()->user();
        return Inertia('Chat/Index',compact('user'));
    }

    public function messages(): Collection|array
    {
        return Message::with('user')->get();
    }

    public function send(MessageFormRequest $request): array
    {
        $message = $request->user()
            ->messages()
            ->create([$request->validated()]);

        broadcast(new MessageSent($request->user(), $message));

        return $message;
    }

}
