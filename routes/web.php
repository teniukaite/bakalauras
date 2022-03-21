<?php

declare(strict_types=1);

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\ConflictHistoryController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', function() {
    if (auth()->check()) {
        auth()->logout();
    }

    return redirect('/');
});

Route::middleware('checkUser')->group(function () {
    Route::get('/history/{conflict}', [ConflictHistoryController::class, 'show'])->name('show.history');
    Route::resource('comments', CommentController::class)->except(['create', 'show']);
    Route::resource('conflicts', ConflictController::class);
    Route::get('comments/create/{file:id}', [CommentController::class, 'create'])->name('comments.create');
    Route::get('comments/{file:id}', [CommentController::class, 'show'])->name('comments.show');
});

Route::middleware('freelancer')->prefix('freelancer')->group(function () {
    Route::resource('offers', OffersController::class);
});

Route::middleware('moderator')->prefix('moderator')->group(function () {
    Route::get('/conflicts', [ModeratorController::class, 'getConflicts']);
    Route::get('/conflict/{conflict}', [ModeratorController::class, 'showConflict'])->name('moderator.show.conflict');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);

