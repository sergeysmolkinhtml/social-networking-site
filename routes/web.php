<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MyFriendsController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NewsPage;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicUserFriendsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 161 185

require 'social.php';
require 'chat.php';

Route::get( '', [NewsPage::class, 'index'])->name('news.index');
Route::get('search',[SearchController::class,'results'])->name('search.results');
Route::post('notifications',[NotificationsController::class,'get']);
Route::get('/alert',function (){
    return redirect()->route('home')
        ->with('info','You can now log in');
});

/**
 * Private Profile
 */
Route::middleware('auth')->group(function (){
    Route::get( 'page/{nickname}', [MyPageController::class, 'index'])->name('page.index');
    Route::get( '{nickname}/friends',[MyFriendsController::class,'index'])->name('friends.index');
    Route::get( 'friends/add/{nickname}',[MyFriendsController::class,'addFriend'])->name('friend.add');
    Route::get( 'friends/accept/{nickname}',[MyFriendsController::class,'acceptFriend'])->name('friend.accept');
    Route::post( 'friends/delete/{nickname}',[MyFriendsController::class,'deleteFriend'])->name('friend.delete');
    Route::post('{nickname}/pfp/upload',[ImageController::class,'upload'])->name('pfp.upload');

});

/**
 * Public Profile
 */
Route::get('/user/{nickname}',[ProfileController::class,'profile'])->name('user_profile.index');
Route::get('/user/{nickname}/friends/',[PublicUserFriendsController::class,'index'])->name('user_friends.index');

/**
 * Blog Posts
 */
Route::middleware('auth')->group(function () {
    Route::post('post', [PostController::class, 'store'])->name('blog.post');
    Route::get( 'post/detail',[PostController::class,'create'])->name('post.detail');
    Route::get('post/{post_id}/like',[PostController::class,'like'])->name('post.like');
});

Route::post('post/{post_id}/reply',[PostController::class,'comment'])->name('post.comment');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
