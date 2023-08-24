<?php


namespace app\Models;

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;

Route::post('newsletter', NewsletterController::class);


Route::get('/',[PostController::class, 'index'])->name('home');

Route::get('posts/{post}',[PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('/register',[RegisterController::class, 'create'])->middleware('guest');
Route::post('/register',[RegisterController::class, 'store'])->middleware('guest');
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/sessions', [SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

//Admin

Route::prefix('admin')->middleware('admin')->group(function() {
    Route::post('posts', [AdminPostController::class, 'store']);
    Route::get('posts/create', [AdminPostController::class, 'create']);
    Route::get('posts', [AdminPostController::class, 'index']);
    Route::get('posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('posts/{id}/edit', [AdminPostController::class, 'update']);
    Route::delete('posts/{id}', [AdminPostController::class, 'destroy']);
});