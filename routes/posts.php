<?php


use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get( 'posts',               [PostController::class, 'index'])  ->name('index');
Route::post('post',                [PostController::class, 'store'])  ->name('store');
Route::get( 'post/{post}',         [PostController::class, 'show'])   ->name('show');
Route::put( 'post/{post}',         [PostController::class, 'update']) ->name('update');
Route::get( 'post/{post}/edit',    [PostController::class, 'edit'])   ->name('edit');
Route::get( 'post/create',         [PostController::class, 'create']) ->name('create');

Route::get( 'post/{post_id}/like', [PostController::class, 'like'])   ->name('like');
Route::post('post/{post_id}/reply',[PostController::class, 'comment'])->name('comment');
