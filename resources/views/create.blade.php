<x-layout title="Add a Game">
    <form method="POST" action="{{ route('games.store') }}">
        @csrf

        <div>
            <label for="name">Game name</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >
            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                required
            >{{ old('description') }}</textarea>
            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="developer">Developer</label>
            <input
                id="developer"
                type="text"
                name="developer"
                value="{{ old('developer') }}"
                required
            >
            @error('developer')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="genres">Genres</label>
            <input
                id="genres"
                type="text"
                name="genres"
                value="{{ old('genres') }}"
                placeholder="Action, Adventure, RPG"
                required
            >
            @error('genres')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image">Image URL</label>
            <input
                id="image"
                type="url"
                name="image"
                value="{{ old('image') }}"
            >
            @error('image')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Add game</button>
    </form>
</x-layout>
