<x-layout title="Add a Game">

    <form method="POST" action="{{route('games.store')}}">
        <x-input>
            <label for="name">Game Name</label>
            <input type="text" name="name" placeholder="">
        </x-input>
    </form>


</x-layout>
