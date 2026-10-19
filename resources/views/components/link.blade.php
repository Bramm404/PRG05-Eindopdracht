@props(['active' => false])

<a class="underline " {{$active ? $attributes : $attributes->except('href')}} style="color: {{$active ? 'gray' : 'black'}}; text-decoration: none">{{$slot}}</a>
