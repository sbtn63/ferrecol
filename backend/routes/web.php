<?php

use Illuminate\Support\Facades\Route;
/* use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController; */

Route::view('/', 'welcome');

/* Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'auth'])->name('auth');
Route::get('/register', [AuthController::class, 'create'])->name('create');
Route::post('/register', [AuthController::class, 'register'])->name('register'); */

Route::middleware('auth:sanctum')->group(function () {
    /* Route::post('logout/', [AuthController::class, 'destroy'])->name('logout');

    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

    Route::get('profile/{id}', [UserController::class, 'show'])->name('user.show'); */
});
