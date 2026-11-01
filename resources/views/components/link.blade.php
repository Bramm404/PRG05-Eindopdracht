@props(['active' => false])

<a
    {{ $attributes->merge([
        'class' =>
            'rounded-lg px-4 py-2 text-sm font-semibold transition ' .
            ($active ? 'bg-navy-500 text-white' : 'text-black-200 hover:bg-black-900 hover:text-white'),
    ]) }}>{{ $slot }}</a>
