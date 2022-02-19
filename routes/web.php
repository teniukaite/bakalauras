<?php declare(strict_types=1);

use App\Http\Controllers\ConflictController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('checkUser')->group(function () {
    Route::resource('conflicts', ConflictController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);

