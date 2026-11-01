<x-layout title="{{ $game->name }}">
    <div class="mx-auto flex max-w-4xl flex-col gap-8 px-4 py-10 sm:px-6">
        <a href="{{ route('games.index') }}" class="self-start font-semibold text-indigo-600 hover:text-indigo-800">&larr;
            Back to games</a>
        @if (session('status'))
            <p class="rounded-lg bg-emerald-50 p-3 text-emerald-700">{{ session('status') }}</p>
        @endif
        <article class="flex flex-col gap-5 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            @if ($game->imageUrl())
                <img src="{{ $game->imageUrl() }}" alt="{{ $game->name }}"
                    class="max-h-96 w-full rounded-lg object-cover">
            @endif
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">{{ $game->name }}</h1>
                    <p class="text-slate-500">Door {{ $game->developer->name }} · Gepost door {{ $game->user->name }}
                    </p>
                </div>
                @auth
                    <form method="POST" action="{{ route('games.favorite', $game) }}">@csrf
                        <button
                            class="rounded-lg border border-navy-200 px-4 py-2 font-semibold text-navy-700 hover:bg-navy-50">♡
                            Favoriet</button>
                    </form>
                @endauth
            </div>
            <p class="whitespace-pre-line text-slate-700">{{ $game->description }}</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($game->genres as $genre)
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">{{ $genre->name }}</span>
                @endforeach
            </div>
            @auth
                @if (auth()->user()->is_admin || auth()->id() === $game->user_id)
                    <div class="flex gap-3 border-t pt-4"><a href="{{ route('games.edit', $game) }}"
                            class="font-semibold text-navy-600">Bewerken</a>
                        <form method="POST" action="{{ route('games.destroy', $game) }}">@csrf @method('DELETE')<button
                                class="font-semibold text-red-600">Verwijderen</button></form>
                    </div>
                @endif
            @endauth
        </article>
        <section class="flex flex-col gap-4">
            <h2 class="text-2xl font-bold text-slate-900">Reacties ({{ $game->comments->count() }})</h2>
            @auth
                <form method="POST" action="{{ route('comments.store', $game) }}"
                    class="flex flex-col gap-3 rounded-xl bg-white p-5 shadow-sm">@csrf
                    <textarea name="body" required maxlength="2000" rows="3" placeholder="Deel je mening..."
                        class="rounded-lg border-slate-300"></textarea><button
                        class="self-start rounded-lg bg-navy-500 px-4 py-2 font-semibold text-white">Reageren</button>
                </form>
            @endauth
            @foreach ($game->comments as $comment)
                <div x-data="{ editing: false }" class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <div class="flex justify-between"><strong>{{ $comment->user->name }}</strong><span
                            class="text-sm text-slate-500">{{ $comment->created_at->diffForHumans() }}</span></div>
                    <p x-show="!editing" class="mt-2 text-slate-700">{{ $comment->body }}</p>
                    @auth
                        @if (auth()->user()->is_admin || auth()->id() === $comment->user_id)
                            <div class="mt-3 flex flex-wrap gap-3">
                                <button type="button" x-show="!editing" @click="editing = true"
                                    class="text-sm font-semibold text-navy-600">Bewerken</button>
                                <div x-show="editing" class="flex flex-1 flex-wrap gap-3">
                                    <form method="POST" action="{{ route('comments.update', $comment) }}"
                                        class="flex min-w-[16rem] flex-1 gap-2">
                                        @csrf @method('PUT')
                                        <input name="body" value="{{ $comment->body }}" maxlength="2000" required
                                            class="min-w-0 flex-1 rounded-lg border-slate-300 text-sm">
                                        <button class="text-sm font-semibold text-navy-600">Opslaan</button>
                                    </form>
                                    <button type="button" @click="editing = false"
                                        class="text-sm font-semibold text-slate-600">Annuleren</button>
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-sm font-semibold text-red-600">Verwijderen</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        </section>
    </div>
</x-layout>
