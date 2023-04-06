<?php

use App\Broadcasting\ChatChannel;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('chat', [ChatChannel::class,'join']);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
