<?php

use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NewsPage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
// 161 185

require 'chat.php';

Route::get('', [NewsPage::class, 'index'])->name('news.index');
Route::get('{nickname}', [MyPageController::class, 'index'])->name('page.index');
Route::get('{nickname}/friends',[FriendsController::class,'index'])->name('friends.index');
Route::post('{nickname}/pfp/upload',[ImageController::class,'upload'])->name('pfp.upload');

require 'social.php';
require 'auth.php';


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
