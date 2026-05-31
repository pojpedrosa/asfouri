@props(['class' => 'h-10 w-auto'])

{{-- asfouri mark — a seed that puts down roots and rises in two leaves.
     Rooted, and taking flight. Inherits currentColor. --}}
<svg {{ $attributes->merge(['class' => $class]) }}
     viewBox="0 0 48 72" fill="none" xmlns="http://www.w3.org/2000/svg"
     role="img" aria-hidden="true">
    {{-- roots --}}
    <path d="M24 49 L24 67 M24 53 C21 58 17 60 13 63 M24 53 C27 58 31 61 35 64"
          stroke="currentColor" stroke-width="2.2" stroke-linecap="round" opacity="0.7"/>
    {{-- seed --}}
    <circle cx="24" cy="46" r="4.4" fill="currentColor"/>
    {{-- stem --}}
    <path d="M24 46 C24 39 23 33 24 27"
          stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
    {{-- right leaf (a wing rising) --}}
    <path d="M24 31 C30 28 38 19 41 9 C32 11 26 20 24 31 Z" fill="currentColor"/>
    {{-- left leaf --}}
    <path d="M24 37 C18 35 12 29 9 22 C16 23 21 29 24 37 Z" fill="currentColor" opacity="0.78"/>
</svg>
