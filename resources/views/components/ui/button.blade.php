@props([
    'href' => null,
    'variant' => 'primary', // primary | outline | light | ghost
    'size' => 'md',         // md | lg
])

@php
    $base = 'group inline-flex items-center justify-center gap-2 rounded-full font-semibold tracking-tight transition duration-200 focus-visible:outline-2 focus-visible:outline-offset-2';

    $sizes = [
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-7 py-3.5 text-base',
    ];

    $variants = [
        // Solid electric blue with cream text — the primary action (reads on cream).
        'primary' => 'bg-blue-500 text-cream hover:bg-blue-700 shadow-sm hover:shadow-md',
        // Blue outline + blue text — quiet on cream, becomes solid on hover.
        'outline' => 'border border-blue-500/60 text-blue-500 hover:border-blue-500 hover:bg-blue-500 hover:text-cream',
        // Cream/paper fill with blue text — the primary action ON a blue band.
        'light'   => 'bg-cream text-blue-700 hover:bg-paper shadow-sm',
        // Text-only — blue on cream, deepens on hover.
        'ghost'   => 'text-blue-500 hover:text-blue-700',
    ];

    $classes = implode(' ', [$base, $sizes[$size] ?? $sizes['md'], $variants[$variant] ?? $variants['primary']]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'submit']) }}>
        {{ $slot }}
    </button>
@endif
