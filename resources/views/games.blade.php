<x-layout title="Games">
    <a href="create">Add a game</a>
    @foreach($games as $game)
        <card style="border: 1px solid black; background-color: #f0f0f0; display: flex; text-align: center; flex-direction: column; width: 40%">
            <h1>{{$game['name']}}</h1>
            <text>{{$game['description']}}</text>
            <a href="/games/{{$game['id']}}">View Details</a>
        </card>
    @endforeach
</x-layout>
