<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-lg border border-transparent bg-navy-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-navy-600 focus:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-navy-300 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
