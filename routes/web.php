<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsPage;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Pages\CandidateProfile;
use App\Http\Middleware\EnsureUserIsEmployer;
use Illuminate\Support\Facades\Route;

// 161 185

require 'social.php';


Route::get('/',function (){
    return 'Sign In / Sign Up page';
});

Route::get( 'news',          [NewsPage::class, 'index'])->name('news.index');
Route::get( 'search',        [SearchController::class,'results'])->name('search.results');
Route::post('notifications', [NotificationsController::class,'get']);

Route::get( '/alert',function (){
    return redirect()->route('home')
        ->with('info','alert');
});

/**
 * Profile
 */
Route::get('user/{nickname}',   [ProfileController::class,'profile'])->name('user_profile.index');
Route::get('{nickname}/friends', [FriendsController::class, 'index'])->name('friends.index');


Route::middleware('auth')->group(function () {
    Route::get('friends/add/{nickname}', [FriendsController::class, 'addFriend'])->name('friend.add');
    Route::get('friends/accept/{nickname}', [FriendsController::class, 'acceptFriend'])->name('friend.accept');
    Route::post('friends/delete/{nickname}', [FriendsController::class, 'deleteFriend'])->name('friend.delete');
    Route::post('{nickname}/pfp/upload', [ImageController::class, 'uploadPfp'])->name('pfp.upload');
});

/**
 * Employer
 */
Route::get('{id}/to-employer/', [EmployerController::class, 'changeToEmployer'])->name('change-to-emp');

/**
 * Candidate Profile
 */
Route::get('candidate/id/{user}', [CandidateProfile::class, 'render'])->name('user_candidate.index');


/**
 * Blog Posts
 */
Route::middleware('auth')->group(function () {
    Route::post('post', [PostController::class, 'store'])->name('blog.post');
    Route::get('post/detail', [PostController::class, 'create'])->name('post.detail');
    Route::get('post/{post_id}/like', [PostController::class, 'like'])->name('post.like');
});

Route::post('post/{post_id}/reply', [PostController::class, 'comment'])->name('post.comment');


/**
 * Chat with candidate
 */
Route::controller(ChatController::class)
    ->middleware(EnsureUserIsEmployer::class)->group(function ()
    {
        Route::get('/dialogues/{nickname}/', 'index')->name('dialogues.dash');
        Route::get('/messages', 'messages');
        Route::post('/send', 'send');
    });


/**
 * Profile Settings
 */
Route::middleware([
    'auth:sanctum',
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/user-settings', function () {
        return view('dashboard');
    })->name('dashboard');
});
