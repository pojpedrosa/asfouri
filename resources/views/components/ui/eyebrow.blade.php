@props(['class' => ''])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-blue-500 '.$class]) }}>
    <span class="inline-block h-1.5 w-1.5 rounded-full bg-coral"></span>
    {{ $slot }}
</span>
