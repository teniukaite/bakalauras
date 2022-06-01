<?php

declare(strict_types=1);

use App\Http\Controllers\AdditionalInformationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\ConflictHistoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserRequestsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landingPage']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/messages/sent', [MessageController::class, 'showSentMessages'])->name('messages.sent');
    Route::resource('messages', MessageController::class);
    Route::resource('orders', OrderController::class);
    #Requests
    Route::resource('/user_requests', UserRequestsController::class);
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
    Route::get('comments/create/{file:id}', [CommentController::class, 'create'])->name('comments.create');
    Route::get('comments/{file:id}', [CommentController::class, 'show'])->name('comments.show');
    Route::resource('comments', CommentController::class)->except(['create', 'show']);
    Route::resource('conflicts', ConflictController::class);
    Route::get('/submit/{token}/information', [ConflictController::class, 'getInformationForm'])->name('conflict.get.information.form');
    Route::post('/submit/{conflict}/information', [AdditionalInformationController::class, 'store'])->name('conflict.post.information.form');
    Route::get('/my-profile', [UserController::class, 'myAccount'])->name('users.myAccount');
});

Route::middleware('freelancer')->prefix('freelancer')->group(function () {
    Route::resource('offers', OffersController::class)->except('show');
});

Route::middleware('moderator')->prefix('moderator')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/conflicts', [ModeratorController::class, 'getConflicts'])->name('moderator.conflicts');
    Route::get('/conflict/{conflict:id}', [ModeratorController::class, 'showConflict'])->name('moderator.show.conflict');
    Route::get('/conflict/information/{conflict}', [ModeratorController::class, 'openInformationRequest'])->name('moderator.need.conflict.information');
    Route::post('/conflict/information/{conflict}', [ModeratorController::class, 'sendInformationRequest'])->name('moderator.send.conflict.information');
    Route::post('/conflict/{conflict}/close', [ModeratorController::class, 'saveDecision'])->name('moderator.close.conflict');
    Route::resource('requests', RequestController::class);
    Route::post('/requests/{request}/answer', [RequestController::class, 'answer'])->name('requests.answer');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/users/checkPoints', [UserController::class, 'countPoints'])->name('users.countPoints');
    Route::get('/users/blacklist', [UserController::class, 'blacklist'])->name('users.blacklist');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('/offers', [AdminController::class, 'getOffers'])->name('admin.offers');
    Route::post('/recommend/{offer}', [AdminController::class, 'recommendOffer'])->name('admin.recommend');
    Route::post('/unrecommend/{offer}', [AdminController::class, 'unrecommendOffer'])->name('admin.unrecommend');
    Route::get('/newsletters/sendPDF/{newsletter:id}', [NewsletterController::class, 'sendPDF'])->name('newsletters.sendPDF');
    Route::get('/newsletters/generatePDF/{newsletter:id}', [NewsletterController::class, 'generatePDF'])->name('newsletters.generatePDF');
    Route::resource('newsletters', NewsletterController::class);
    Route::patch('/user/{user}/add/points', [UserController::class, 'addPoints'])->name('user.addPoints');
    Route::patch('/user/{user}/remove/points', [UserController::class, 'removePoints'])->name('user.removePoints');
});

#offers
Route::post('/offers/{offer:id}/review', [ReviewController::class, 'store'])->name('offers.review');
Route::get('/offers', [OffersController::class, 'list'])->name('offers.list');
Route::resource('offers', OffersController::class)->only('show');
Route::get('/freelancers/{freelancer:id}/offers', [FreelancerController::class, 'offers'])->name('freelancers.offers');
Route::resource('freelancers', FreelancerController::class)->only('index');
