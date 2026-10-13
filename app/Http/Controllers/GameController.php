<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index() {

        $games = Game::all();
        return view('games', compact('games'));
    }

    public function show($id) {
        $game = Game::findOrFail($id);
        return view('game', compact('game'));
    }
}
