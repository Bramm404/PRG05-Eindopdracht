<x-layout title="{{ $game->name }} bewerken">
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <a href="{{ route('games.index') }}"
            class="mb-6 inline-block font-semibold text-indigo-600 hover:text-indigo-800">&larr; Back to games</a>
        <h1 class="mb-6 text-3xl font-bold text-slate-900">Game bewerken</h1>
        <form method="POST" action="{{ route('games.update', $game) }}" enctype="multipart/form-data"
            class="flex flex-col gap-5 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">@csrf @method('PUT')
            @include('games._form', ['game' => $game])
            <button
                class="self-start rounded-lg bg-navy-500 px-5 py-2 font-semibold text-white hover:bg-navy-600">Wijzigingen
                opslaan</button>
        </form>
    </div>
</x-layout>
