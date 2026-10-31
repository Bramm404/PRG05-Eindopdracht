<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user()->load(['favorites.developer', 'comments.game']);

    return view('dashboard', compact('user'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Pages locked behind login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
    Route::post('/games/{game}/favorite', [GameController::class, 'favorite'])->name('games.favorite');
    Route::post('/games/{game}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Games
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

require __DIR__.'/auth.php';
