<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        return view('games', [
            'games' => $this->filteredGames($request),
            'genres' => Genre::query()->orderBy('name')->get(),
        ]);
    }

    private function filteredGames(Request $request)
    {
        $query = Game::query()->with(['developer', 'genres']);

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('developer', fn ($developer) => $developer->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('genres', fn ($genres) => $genres->where('name', 'like', "%{$search}%"));
            });
        }

        $selectedGenres = $request->input('genres', []);
        if (is_array($selectedGenres) && count($selectedGenres) > 0) {
            $query->whereHas('genres', fn ($genres) => $genres->whereIn('genres.id', $selectedGenres));
        }

        return $query->latest('updated_at')->paginate(12)->withQueryString();
    }

    public function show(Game $game): View
    {
        $game->load(['developer', 'genres', 'user', 'comments.user']);

        return view('game', compact('game'));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if (! $this->canPost($request)) {
            return redirect()->route('games.index')->with('post_warning', 'You need at least three comments before you can add a game.');
        }

        return view('create', ['genres' => Genre::query()->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $this->canPost($request)) {
            return redirect()->route('games.index')->with('post_warning', 'You need at least three comments before you can add a game.');
        }
        $validated = $this->validateGame($request);
        $game = $this->persistGame($request, $validated);

        return redirect()->route('games.show', $game)->with('status', 'Game posted.');
    }

    public function edit(Request $request, Game $game): View
    {
        $this->authorizeGame($request, $game);
        $game->load('genres', 'developer');

        return view('edit', [
            'game' => $game,
            'genres' => Genre::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $this->authorizeGame($request, $game);
        $validated = $this->validateGame($request);
        $developer = Developer::firstOrCreate(['name' => $validated['developer']]);

        $game->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'developer_id' => $developer->id,
            'image' => $this->imagePath($request, $validated['image_url'] ?? $game->image),
        ]);
        $game->genres()->sync($this->genreIds($validated['genres']));

        return redirect()->route('games.show', $game)->with('status', 'Game updated.');
    }

    public function destroy(Request $request, Game $game): RedirectResponse
    {
        $this->authorizeGame($request, $game);
        $game->delete();

        return redirect()->route('games.index')->with('status', 'Game deleted.');
    }

    public function favorite(Request $request, Game $game): RedirectResponse
    {
        $request->user()->favorites()->toggle($game);

        return back();
    }

    private function validateGame(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'developer' => ['required', 'string', 'max:255'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'image_url' => ['nullable', 'url', 'max:2048'],
        ]);
    }

    private function persistGame(Request $request, array $validated): Game
    {
        $developer = Developer::firstOrCreate(['name' => $validated['developer']]);
        $game = Game::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $this->imagePath($request, $validated['image_url'] ?? null),
            'user_id' => $request->user()->id,
            'developer_id' => $developer->id,
        ]);
        $game->genres()->sync($this->genreIds($validated['genres']));

        return $game;
    }

    private function genreIds(array $genres): array
    {
        return collect($genres)
            ->map(fn (string $name): string => trim($name))
            ->filter()
            ->unique()
            ->map(fn (string $name): int => Genre::firstOrCreate(['name' => $name])->id)
            ->all();
    }

    private function imagePath(Request $request, ?string $fallback): ?string
    {
        return $request->hasFile('image')
            ? $request->file('image')->store('games', 'public')
            : $fallback;
    }

    private function canPost(Request $request): bool
    {
        return (bool) ($request->user()?->is_admin || $request->user()?->comments()->count() >= 3);
    }

    private function authorizeGame(Request $request, Game $game): void
    {
        abort_unless($request->user()->is_admin || $request->user()->id === $game->user_id, 403);
    }
}
