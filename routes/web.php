<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/games', [GameController::class, 'index']); // games overview route
Route::get ('/games/{game}', [GameController::class, 'show']);

require __DIR__.'/auth.php';
