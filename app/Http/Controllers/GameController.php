<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        $games = Game::latest()->get();

        return view('games', compact('games'));
    }

    public function create(): View
    {
        return view('create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $game = Game::create($validated);

        return redirect()
            ->route('games.show', $game)
            ->with('success', 'Game created successfully.');
    }

    public function show(Game $game): View
    {
        return view('game', compact('game'));
    }

    public function edit(Game $game): View
    {
        return view('edit', compact('game'));
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $game->update($validated);

        return redirect()
            ->route('games.show', $game)
            ->with('success', 'Game updated successfully.');
    }

    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('success', 'Game deleted successfully.');
    }
}
