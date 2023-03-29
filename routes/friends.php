<?php

use App\Http\Controllers\FriendsController;
use Illuminate\Support\Facades\Route;

Route::get( 'friends/add/{nickname}',    [FriendsController::class, 'add'])->name('friend.add');
Route::get( 'friends/accept/{nickname}', [FriendsController::class, 'accept'])->name('friend.accept');
Route::post('friends/delete/{nickname}', [FriendsController::class, 'delete'])->name('friend.delete');

