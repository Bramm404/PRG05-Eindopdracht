<x-layout title="Details - {{$game->name}}">

    <article>
        <h1>{{$game->name}}</h1>
        <p>{{$game->description}}</p>
        <img src="{{$game->image}}" alt="{{$game->name}}">
    </article>

</x-layout>
