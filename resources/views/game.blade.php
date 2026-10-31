<x-layout title="{{ $game->name }}">
    <div class="mx-auto flex max-w-4xl flex-col gap-8 px-4 py-10 sm:px-6">
        @if(session('status')) <p class="rounded-lg bg-emerald-50 p-3 text-emerald-700">{{ session('status') }}</p> @endif
        <article class="flex flex-col gap-5 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            @if($game->imageUrl()) <img src="{{ $game->imageUrl() }}" alt="{{ $game->name }}" class="max-h-96 w-full rounded-lg object-cover"> @endif
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">{{ $game->name }}</h1>
                    <p class="text-slate-500">By {{ $game->developer->name }} · posted by {{ $game->user->name }}</p>
                </div>
                @auth
                    <form method="POST" action="{{ route('games.favorite', $game) }}">@csrf
                        <button class="rounded-lg border border-indigo-200 px-4 py-2 font-semibold text-indigo-700 hover:bg-indigo-50">♡ Favorite</button>
                    </form>
                @endauth
            </div>
            <p class="whitespace-pre-line text-slate-700">{{ $game->description }}</p>
            <div class="flex flex-wrap gap-2">@foreach($game->genres as $genre)<span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">{{ $genre->name }}</span>@endforeach</div>
            @auth
                @if(auth()->user()->is_admin || auth()->id() === $game->user_id)
                    <div class="flex gap-3 border-t pt-4"><a href="{{ route('games.edit', $game) }}" class="font-semibold text-indigo-600">Edit</a><form method="POST" action="{{ route('games.destroy', $game) }}">@csrf @method('DELETE')<button class="font-semibold text-red-600">Delete</button></form></div>
                @endif
            @endauth
        </article>
        <section class="flex flex-col gap-4">
            <h2 class="text-2xl font-bold text-slate-900">Comments ({{ $game->comments->count() }})</h2>
            @auth
                <form method="POST" action="{{ route('comments.store', $game) }}" class="flex flex-col gap-3 rounded-xl bg-white p-5 shadow-sm">@csrf<textarea name="body" required maxlength="2000" rows="3" placeholder="Share your thoughts..." class="rounded-lg border-slate-300"></textarea><button class="self-start rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white">Comment</button></form>
            @endauth
            @foreach($game->comments as $comment)
                <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200"><div class="flex justify-between"><strong>{{ $comment->user->name }}</strong><span class="text-sm text-slate-500">{{ $comment->created_at->diffForHumans() }}</span></div><p class="mt-2 text-slate-700">{{ $comment->body }}</p>@auth @if(auth()->user()->is_admin || auth()->id() === $comment->user_id)<div class="mt-3 flex flex-wrap gap-3"><form method="POST" action="{{ route('comments.update', $comment) }}" class="flex flex-1 gap-2">@csrf @method('PUT')<input name="body" value="{{ $comment->body }}" maxlength="2000" required class="min-w-0 flex-1 rounded-lg border-slate-300 text-sm"><button class="text-sm font-semibold text-indigo-600">Edit</button></form><form method="POST" action="{{ route('comments.destroy', $comment) }}">@csrf @method('DELETE')<button class="text-sm font-semibold text-red-600">Remove</button></form></div>@endif @endauth</div>
            @endforeach
        </section>
    </div>
</x-layout>
