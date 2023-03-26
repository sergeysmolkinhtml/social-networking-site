<?php


use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::post('post',                [PostController::class, 'store'])->name('post.create');
Route::get( 'post/detail',         [PostController::class, 'create'])->name('post.detail');
Route::get( 'post/{post_id}/like', [PostController::class, 'like'])->name('post.like');
Route::post('post/{post_id}/reply',[PostController::class, 'comment'])->name('post.comment');
