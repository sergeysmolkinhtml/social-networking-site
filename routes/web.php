<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NewsPage;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/chat2', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('',[NewsPage::class,'index'])->name('news.index');

Route::post('/image/upload', [ImageController::class,'upload'])->name('image.upload');

Route::get('my{nickname}',[MyPageController::class,'index'])->name('page.index');

include 'UsersChat.php';

require __DIR__ . '/auth.php';
