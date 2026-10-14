<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/games', [GameController::class, 'index']); // games overview route
Route::get ('/games/{game}', [GameController::class, 'show']);
Route::get('/create', [GameController::class, 'create']);
Route::post('/games', [GameController::class, 'store']);

require __DIR__.'/auth.php';
