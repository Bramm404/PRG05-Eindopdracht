<x-layout title="Games">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 lg:px-8">
        @if (session('post_warning'))
            <div role="alert"
                class="flex items-start justify-between gap-4 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900 shadow-sm">
                <p>{{ session('post_warning') }}</p>
            </div>
        @endif
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-navy-500">Communitybibliotheek</p>
                <h1 class="text-3xl font-bold text-black-950">Ontdek games</h1>
            </div>
            @auth
                <a href="{{ route('games.create') }}"
                    class="rounded-lg bg-navy-500 px-4 py-2 font-semibold text-white hover:bg-navy-600">Game toevoegen</a>
            @endauth
        </div>
        <form method="GET" class="flex flex-col gap-4 rounded-xl bg-white p-4 shadow">
            <div class="flex flex-col gap-3 sm:flex-row">
                <input name="search" value="{{ request('search') }}" placeholder="Zoek op game, ontwikkelaar of genre"
                    class="min-w-0 flex-1 rounded-lg border-black-200">
                <button type="submit"
                    class="rounded-lg bg-black-950 px-5 py-2 font-semibold text-white">Zoeken</button>
            </div>
            <details @if (request()->has('genres')) open @endif
                class="rounded-lg border border-black-100 bg-black-50 p-3">
                <summary class="cursor-pointer list-none text-sm font-semibold text-black-800">
                    <span class="flex items-center justify-between gap-3">
                        Filter op genre
                        <span class="text-navy-500">+</span>
                    </span>
                </summary>
                <fieldset class="mt-3 border-t border-black-100 pt-3">
                    <legend class="sr-only">Filter op genre</legend>
                    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($genres as $genre)
                            <label class="flex items-center gap-2 text-sm text-black-800">
                                <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                    @checked(in_array($genre->id, array_map('intval', (array) request('genres', [])), true))>
                                {{ $genre->name }}
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            </details>
        </form>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @include('games._results')
        </div>
        {{ $games->links() }}
    </div>
</x-layout>
