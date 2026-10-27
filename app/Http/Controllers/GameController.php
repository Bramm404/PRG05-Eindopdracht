<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\Genre;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();

        return view('games', compact('games'));
    }

    public function show($id)
    {
        $game = Game::findOrFail($id);
        $developer = Developer::findOrFail($game->developer_id);

        return view('game', compact('game', 'developer'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string|max:255',
            'genres' => 'required|string|max:255',
            'image' => 'nullable|url|max:255',
        ]);

        $developer = new Developer();
        $developer->name = $validated['developer'];
        $developer->save();

        $game = new Game();
        $game->name = $validated['name'];
        $game->description = $validated['description'];
        $game->image = $validated['image'] ?? null;
        $game->user_id = auth()->id();
        $game->developer_id = $developer->id;
        $game->save();

        $genreIds = collect(explode(',', $validated['genres']))
            ->map(fn (string $name) => trim($name))
            ->filter()
            ->map(fn (string $name) => Genre::firstOrCreate(['name' => $name])->id)
            ->all();

        $game->genres()->sync($genreIds);

        return redirect()->route('games.index');
    }
}
