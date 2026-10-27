<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index() {

        $games = Game::all();
        return view('games', compact('games'));
    }

    public function show($id) {
        $game = Game::findOrFail($id);
        $developer = Developer::findOrFail($game->developer_id);
        return view('game', compact('game', 'developer'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {

        $request -> validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
//            'developer' => 'required|string|max:255',
//            'genre' => 'required|string|max:255',
        ]);

//        if (Str::contains($request->genre, ',')) {
//            $genres = array_map('trim', explode(', ', $request->genre))
//        }

        $game = new Game();
        $developer = new Developer();
        $game->name = $request->name;
        $game->description = $request->description;
        $developer->name = $request->developer;

        $developer->save();

        foreach($genres as $genre) {
            $genre->name = $request->genre;
            $game->genres()->save($genre);
            $genre->save();
        }

        $game->user_id = auth()->id();
    }


}
