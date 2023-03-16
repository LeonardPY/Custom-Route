<?php


use App\Http\Controllers\PostController;
use App\RMVC\Route\Route;

Route::get('/', [PostController::class, 'index'])->name('post.index')->middleware('auth');
Route::post('/', [PostController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('/{post}/', [PostController::class, 'show'])->name('post.show')->middleware('auth');