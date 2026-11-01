@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center rounded-lg bg-navy-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-navy-300'
            : 'inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold text-black-200 transition hover:bg-black-900 hover:text-white focus:outline-none focus:ring-2 focus:ring-navy-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
