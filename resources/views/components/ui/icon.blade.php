@props(['name' => '', 'class' => 'h-6 w-6'])

@php
    $paths = [
        // Regenerative communication — speech leaf
        'comms' => '<path d="M4 17V8a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3H9l-5 4z"/><path d="M9 11c1.5-2 4-2.5 6-2-.5 2.5-2 4-4 4"/>',
        // Social — connected seeds
        'social' => '<circle cx="6" cy="7" r="2.2"/><circle cx="18" cy="6" r="2.2"/><circle cx="12" cy="18" r="2.2"/><path d="M7.6 8.6 10.6 16M16.6 7.6 13.6 16M8 7h8"/>',
        // Web platforms — window + sprout
        'web' => '<rect x="3.5" y="4.5" width="17" height="15" rx="2.5"/><path d="M3.5 9h17"/><path d="M12 19v-4M12 15c-1.6 0-2.8-1-3-2.6 1.7-.2 2.8.7 3 2.6zM12 15c1.4 0 2.5-.9 2.7-2.3-1.5-.2-2.5.6-2.7 2.3z"/>',
        // Offline — printed sheet + hand
        'offline' => '<path d="M7 3.5h7l4 4V18a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2z"/><path d="M14 3.5V8h4M8.5 12.5h7M8.5 16h4"/>',
        // AI as regenerative tool — spark leaf
        'ai' => '<path d="M12 3c.6 2.8 1.7 4 4.5 4.6C13.7 8.2 12.6 9.4 12 12c-.6-2.6-1.7-3.8-4.5-4.4C10.3 7 11.4 5.8 12 3z"/><path d="M18 13c.3 1.4.9 2 2.3 2.3-1.4.3-2 .9-2.3 2.3-.3-1.4-.9-2-2.3-2.3 1.4-.3 2-.9 2.3-2.3z"/><path d="M6.5 14c.25 1.1.7 1.6 1.8 1.85C7.2 16.1 6.75 16.6 6.5 17.7c-.25-1.1-.7-1.6-1.8-1.85C5.8 15.6 6.25 15.1 6.5 14z"/>',
        // Branding & illustration — pen nib
        'branding' => '<path d="M4 20l2.5-6.5L15 5a2.1 2.1 0 0 1 3 3l-8.5 8.5L4 20z"/><path d="M13.5 6.5 17 10M6.5 13.5 10 17"/>',
        // Brand management — compass / stewardship
        'brand' => '<circle cx="12" cy="12" r="8.2"/><path d="M14.8 9.2 11 11l-1.8 3.8 3.8-1.8L14.8 9.2z"/><path d="M12 3.8v1.6M12 18.6v1.6M3.8 12h1.6M18.6 12h1.6"/>',

        // Process / principles
        'listen' => '<path d="M5 12a7 7 0 0 1 14 0v3a3 3 0 0 1-3 3"/><rect x="3.5" y="12" width="3.5" height="6" rx="1.5"/><rect x="17" y="12" width="3.5" height="6" rx="1.5"/>',
        'root' => '<path d="M12 3v8M12 11c-2 1.5-3 3.5-3.5 6M12 11c2 1.5 3 3.5 3.5 6M12 11v9"/><circle cx="12" cy="11" r="1.6"/>',
        'cultivate' => '<path d="M12 21v-7M12 14c-2.5 0-4.3-1.6-4.6-4 2.7-.3 4.4 1.1 4.6 4zM12 14c2.4 0 4.2-1.5 4.5-3.8-2.6-.3-4.3 1-4.5 3.8z"/><path d="M5 21h14"/>',
        'flourish' => '<path d="M12 21V9M12 9a3 3 0 1 1 3-3M12 9a3 3 0 1 0-3-3M6 21c0-2.8 2.7-4 6-4s6 1.2 6 4"/>',

        // Care — a heart, tending something alive
        'care' => '<path d="M12 20C12 20 4 14.6 4 9.2 4 6.9 5.9 5 8.2 5c1.6 0 3 .9 3.8 2.2C12.8 5.9 14.2 5 15.8 5 18.1 5 20 6.9 20 9.2 20 14.6 12 20 12 20z"/>',

        // Misc
        'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'check' => '<path d="M5 12.5 10 17 19 7"/>',
        'leaf' => '<path d="M5 19c-1-7 4-13 14-14 1 9-5 14-12 14-1 0-2 0-2 0z"/><path d="M5 19C8 14 12 11 16 9"/>',
    ];
    $d = $paths[$name] ?? '';
@endphp

<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none"
     stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
     aria-hidden="true">
    {!! $d !!}
</svg>
