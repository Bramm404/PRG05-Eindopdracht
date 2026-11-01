@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'rounded-lg border-black-200 bg-white text-black-950 shadow-sm focus:border-navy-400 focus:ring-navy-400']) }}>
