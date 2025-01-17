<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [FeedBackController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('cakes', CakeController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('feedback', FeedbackController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
