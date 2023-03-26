<?php

use App\Http\Controllers\FriendsController;
use Illuminate\Support\Facades\Route;

Route::get( 'friends/add/{nickname}',    [FriendsController::class, 'add']);
Route::get( 'friends/accept/{nickname}', [FriendsController::class, 'accept']);
Route::post('friends/delete/{nickname}', [FriendsController::class, 'delete']);

