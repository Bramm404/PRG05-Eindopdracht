@forelse($games as $game)
    <article class="flex flex-col gap-4 overflow-hidden rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        @if ($game->imageUrl())
            <img src="{{ $game->imageUrl() }}" alt="{{ $game->name }}" class="h-40 w-full rounded-lg object-cover">
        @endif
        <div class="flex flex-1 flex-col gap-2">
            <h2 class="text-xl font-bold text-slate-900">{{ $game->name }}</h2>
            <p class="text-sm text-slate-500">By {{ $game->developer->name }}</p>
            <p class="line-clamp-3 text-slate-600">{{ $game->description }}</p>
            <a href="{{ route('games.show', $game) }}"
                class="mt-auto pt-3 font-semibold text-navy-600 hover:text-navy-800">Bekijk details &rarr;</a>
        </div>
    </article>
@empty
    <p class="text-black-700">Geen games gevonden voor je zoekopdracht.</p>
@endforelse
