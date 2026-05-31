@props([
    'href' => null,
    'variant' => 'primary', // primary | outline | light | ghost
    'size' => 'md',         // md | lg
])

@php
    $base = 'group inline-flex items-center justify-center gap-2 rounded-full font-semibold transition duration-200 focus-visible:outline-2 focus-visible:outline-offset-2';

    $sizes = [
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-7 py-3.5 text-base',
    ];

    $variants = [
        'primary' => 'bg-clay-500 text-parchment hover:bg-clay-600 shadow-sm hover:shadow-md',
        'outline' => 'border border-soil-300 text-soil-800 hover:border-soil-500 hover:bg-soil-50',
        'light'   => 'bg-parchment text-soil-900 hover:bg-white shadow-sm',
        'ghost'   => 'text-soil-700 hover:text-clay-600',
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
