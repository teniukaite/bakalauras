<?php

declare(strict_types=1);

use App\Http\Controllers\AdditionalInformationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\ConflictHistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landingPage']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('messages', MessageController::class);
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
    Route::get('/submit/{token}/information', [ConflictController::class, 'getInformationForm'])->name('conflict.get.information.form');
    Route::post('/submit/{conflict}/information', [AdditionalInformationController::class, 'store'])->name('conflict.post.information.form');
});

Route::middleware('freelancer')->prefix('freelancer')->group(function () {
    Route::resource('offers', OffersController::class);
});

Route::middleware('moderator')->prefix('moderator')->group(function () {
    Route::get('/conflicts', [ModeratorController::class, 'getConflicts'])->name('moderator.conflicts');
    Route::get('/conflict/{conflict:id}', [ModeratorController::class, 'showConflict'])->name('moderator.show.conflict');
    Route::get('/conflict/information/{conflict}', [ModeratorController::class, 'openInformationRequest'])->name('moderator.need.conflict.information');
    Route::post('/conflict/information/{conflict}', [ModeratorController::class, 'sendInformationRequest'])->name('moderator.send.conflict.information');
    Route::post('/conflict/{conflict}/close', [ModeratorController::class, 'saveDecision'])->name('moderator.close.conflict');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/offers', [AdminController::class, 'getOffers'])->name('admin.offers');
    Route::post('/recommend/{offer}', [AdminController::class, 'recommendOffer'])->name('admin.recommend');
    Route::resource('newsletters', NewsletterController::class);
});

