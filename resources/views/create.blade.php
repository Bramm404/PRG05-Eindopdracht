<x-layout title="Add a game">
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-3xl font-bold text-slate-900">Add a game</h1>
        <p class="mb-6 rounded-lg bg-indigo-50 p-4 text-indigo-800">You need at least three comments before you can post. Admins can post immediately.</p>
        <form method="POST" action="{{ route('games.store') }}" enctype="multipart/form-data" class="flex flex-col gap-5 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">@csrf
            @include('games._form')
            <button class="self-start rounded-lg bg-indigo-600 px-5 py-2 font-semibold text-white hover:bg-indigo-700">Publish game</button>
        </form>
    </div>
</x-layout>
