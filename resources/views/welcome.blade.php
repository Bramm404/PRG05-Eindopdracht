<x-layout title="The Games Corner">
    <main class="mx-auto flex max-w-7xl flex-col gap-10 px-4 py-16 sm:px-6 lg:px-8">
        <section
            class="overflow-hidden rounded-3xl bg-gradient-to-br from-black-950 via-prussian-blue-900 to-navy-700 px-6 py-12 text-white shadow-2xl sm:px-12">
            <div class="flex flex-col gap-5">
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-navy-200">The Games Corner</p>
                <h1 class="text-4xl font-black tracking-tight sm:text-6xl">Vind je volgende favoriete game.</h1>
                <p class="max-w-2xl text-lg leading-8 text-black-100">Ontdek games van de community, deel jouw favorieten
                    en bouw een bibliotheek met games waar je van houdt.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('games.index') }}"
                        class="rounded-lg bg-navy-400 px-5 py-3 font-bold text-white shadow-lg transition hover:bg-navy-300">Bekijk
                        games</a>
                    @guest
                        <a href="{{ route('register') }}"
                            class="rounded-lg border border-white/30 px-5 py-3 font-bold text-white transition hover:bg-white/10">Word
                            lid</a>
                    @endguest
                </div>
            </div>
        </section>
        @if ($latestGame)
            <section class="flex flex-col gap-5 rounded-2xl bg-white p-6 shadow-xl ring-1 ring-black-100 sm:p-8">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-navy-500">Nieuwste toevoeging</p>
                    <h2 class="mt-2 text-3xl font-black text-black-950">{{ $latestGame->name }}</h2>
                    <p class="mt-2 text-black-700">Door {{ $latestGame->developer->name }}</p>
                </div>
                <p class="text-black-800">{{ $latestGame->description }}</p>
                <a href="{{ route('games.show', $latestGame) }}"
                    class="self-start rounded-lg bg-navy-500 px-5 py-3 font-bold text-white transition hover:bg-navy-600">Bekijk
                    game</a>
            </section>
        @endif
    </main>
</x-layout>
