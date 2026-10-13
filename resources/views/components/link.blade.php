@props(['active' => false])

<a {{$active ? $attributes : $attributes->except('href')}} style="color: {{$active ? 'gray' : 'black'}}; text-decoration: none">{{$slot}}</a>
