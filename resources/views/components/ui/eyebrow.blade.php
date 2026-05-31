@props(['class' => ''])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-clay-600 '.$class]) }}>
    <span class="inline-block h-1.5 w-1.5 rounded-full bg-clay-500"></span>
    {{ $slot }}
</span>
