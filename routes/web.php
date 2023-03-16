<?php

use App\Http\Controllers\FriendsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NewsPage;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 161 185

require 'social.php';
require 'chat.php';

Route::get( '', [NewsPage::class, 'index'])->name('news.index');
Route::get('search',[SearchController::class,'results'])->name('search.results');
Route::get('/alert',function (){
    return redirect()->route('home')->with('info','You can now log in');
});

Route::middleware('auth')->group(function (){
    Route::get( 'page/{nickname}', [MyPageController::class, 'index'])->name('page.index');
    Route::get( '{nickname}/friends',[FriendsController::class,'index'])->name('friends.index');
    Route::post('{nickname}/pfp/upload',[ImageController::class,'upload'])->name('pfp.upload');
    Route::post('/notifications',[NotificationsController::class,'get']);
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
