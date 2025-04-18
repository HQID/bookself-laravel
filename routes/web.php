<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ReviewController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/collection', function () {
    return view('collection');
})->middleware(['auth', 'verified'])->name('collection');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/collection', [BookController::class, 'index'])->name('collection');
    Route::post('/collection', [BookController::class, 'store'])->name('collection.store');
    Route::patch('/collection/{book}', [BookController::class, 'update'])->name('collection.update');
    Route::delete('/collection/{book}', [BookController::class, 'destroy'])->name('collection.destroy');
    Route::get('/collection/{book}', [BookController::class, 'show'])->name('collection.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::resource('reviews', ReviewController::class)->middleware('auth');

require __DIR__.'/auth.php';
