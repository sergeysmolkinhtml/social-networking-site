<?php

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NewsPage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('', [NewsPage::class, 'index'])->name('news.index');
Route::get('mypage', [MyPageController::class, 'index'])->name('page.index');

Route::get('/auth/google',[SocialAuthController::class,'googleRedirect'])->name('auth.google');
Route::get('/auth/google/callback',[SocialAuthController::class,'loginWithGoogle']);

require __DIR__.'/auth.php';
require 'UsersChat.php';
