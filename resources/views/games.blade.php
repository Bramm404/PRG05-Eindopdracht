<x-layout title="Games">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Community library</p>
                <h1 class="text-3xl font-bold text-slate-900">Discover games</h1>
            </div>
            @auth
                <a href="{{ route('games.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700">Add a game</a>
            @endauth
        </div>
        <form method="GET" class="grid gap-3 rounded-xl bg-white p-4 shadow sm:grid-cols-[1fr_auto_auto]">
            <input name="search" value="{{ request('search') }}" placeholder="Search by game or developer" class="rounded-lg border-slate-300">
            <select name="genre" class="rounded-lg border-slate-300">
                <option value="">All genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" @selected(request('genre') == $genre->id)>{{ $genre->name }}</option>
                @endforeach
            </select>
            <button class="rounded-lg bg-slate-900 px-5 py-2 font-semibold text-white">Search</button>
        </form>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($games as $game)
                <article class="flex flex-col gap-4 overflow-hidden rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    @if($game->imageUrl())
                        <img src="{{ $game->imageUrl() }}" alt="{{ $game->name }}" class="h-40 w-full rounded-lg object-cover">
                    @endif
                    <div class="flex flex-1 flex-col gap-2">
                        <h2 class="text-xl font-bold text-slate-900">{{ $game->name }}</h2>
                        <p class="text-sm text-slate-500">By {{ $game->developer->name }}</p>
                        <p class="line-clamp-3 text-slate-600">{{ $game->description }}</p>
                        <a href="{{ route('games.show', $game) }}" class="mt-auto pt-3 font-semibold text-indigo-600 hover:text-indigo-800">View details &rarr;</a>
                    </div>
                </article>
            @empty
                <p class="text-slate-600">No games match your search.</p>
            @endforelse
        </div>
        {{ $games->links() }}
    </div>
</x-layout>
