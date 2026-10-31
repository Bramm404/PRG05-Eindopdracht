<x-layout title="Dashboard">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 lg:px-8">
        <div><p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Welcome back</p><h1 class="text-3xl font-bold text-slate-900">{{ $user->name }}'s dashboard</h1></div>
        <div class="grid gap-6 lg:grid-cols-2">
            <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200"><h2 class="mb-4 text-xl font-bold">Favorite games</h2><div class="flex flex-col gap-3">@forelse($user->favorites as $game)<a class="rounded-lg bg-slate-50 p-3 font-semibold text-indigo-700 hover:bg-indigo-50" href="{{ route('games.show', $game) }}">{{ $game->name }} <span class="font-normal text-slate-500">by {{ $game->developer->name }}</span></a>@empty<p class="text-slate-500">You have no favorites yet.</p>@endforelse</div></section>
            <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200"><h2 class="mb-4 text-xl font-bold">Your comments</h2><div class="flex flex-col gap-3">@forelse($user->comments as $comment)<a class="rounded-lg bg-slate-50 p-3 text-slate-700 hover:bg-indigo-50" href="{{ route('games.show', $comment->game) }}"><span class="font-semibold">{{ $comment->game->name }}</span><br>{{ $comment->body }}</a>@empty<p class="text-slate-500">You have not commented yet.</p>@endforelse</div></section>
        </div>
    </div>
</x-layout>
