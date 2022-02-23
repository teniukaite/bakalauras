<?php

declare(strict_types=1);

use App\Http\Controllers\ConflictController;
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

});

Route::middleware('freelancer')->group(function () {
    Route::resource('offers', OffersController::class);
});

Route::middleware('moderator')->prefix('moderator')->group(function () {
    Route::get('/conflicts', [ModeratorController::class, 'getConflicts']);
    Route::get('/conflict/{conflict}', [ModeratorController::class, 'showConflict'])->name('moderator.show.conflict');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('conflicts', ConflictController::class);

