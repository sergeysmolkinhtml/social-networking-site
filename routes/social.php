<?php

use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;


Route::get('/auth/google',[SocialAuthController::class,'googleRedirect'])->name('auth.google');
Route::get('/auth/google/callback',[SocialAuthController::class,'loginWithGoogle']);
