<x-layout title="Dashboard">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-2xl bg-gradient-to-r from-black-950 to-prussian-blue-900 p-8 text-white shadow-xl">
            <p class="text-sm font-semibold uppercase tracking-wide text-navy-200">Welkom terug</p>
            <h1 class="mt-2 text-3xl font-bold">Dashboard van {{ $user->name }}</h1>
        </div>
        <div class="grid gap-6 lg:grid-cols-2">
            <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-black-100">
                <h2 class="mb-4 text-xl font-bold">Favoriete games</h2>
                <div class="flex flex-col gap-3">
                    @forelse($user->favorites as $game)
                        <a class="rounded-lg bg-black-50 p-3 font-semibold text-navy-700 hover:bg-navy-50"
                            href="{{ route('games.show', $game) }}">
                            {{ $game->name }}
                            <span class="font-normal text-black-700">door {{ $game->developer->name }}</span>
                        </a>
                    @empty
                        <p class="text-black-700">Je hebt nog geen favoriete games.</p>
                    @endforelse
                </div>
            </section>
            <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-black-100">
                <h2 class="mb-4 text-xl font-bold">Jouw reacties</h2>
                <div class="flex flex-col gap-3">
                    @forelse($user->comments as $comment)
                        <a class="rounded-lg bg-black-50 p-3 text-black-800 hover:bg-navy-50"
                            href="{{ route('games.show', $comment->game) }}">
                            <span class="font-semibold">{{ $comment->game->name }}</span>
                            <span class="font-normal text-black-700">door {{ $comment->game->developer->name }}</span>
                            <br>
                            {{ $comment->body }}
                        </a>
                    @empty
                        <p class="text-black-700">Je hebt nog geen reacties geplaatst.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-layout>
