@props([
    'eyebrow' => null,
    'heading' => null,
    'text' => null,
])

<section class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="grain relative overflow-hidden rounded-[2rem] bg-clay-500 px-6 py-16 text-parchment sm:px-12 sm:py-20">
        {{-- decorative drifting seed/bird --}}
        <svg class="animate-drift pointer-events-none absolute -right-6 -top-6 h-40 w-40 text-clay-400/50" viewBox="0 0 48 72" fill="none" aria-hidden="true">
            <path d="M24 31 C30 28 38 19 41 9 C32 11 26 20 24 31 Z" fill="currentColor"/>
            <path d="M24 37 C18 35 12 29 9 22 C16 23 21 29 24 37 Z" fill="currentColor"/>
        </svg>
        <div class="relative max-w-2xl">
            @if ($eyebrow)
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-clay-100">{{ $eyebrow }}</span>
            @endif
            <h2 class="mt-3 font-display text-3xl font-medium text-balance sm:text-5xl">
                {{ $heading ?? __('Vamos plantar algo juntos?') }}
            </h2>
            @if ($text !== false)
                <p class="mt-5 max-w-xl text-pretty text-clay-50/90 sm:text-lg">
                    {{ $text ?? __('Conte-nos o que está a cultivar. Respondemos a cada mensagem com atenção e sem pressa.') }}
                </p>
            @endif
            <div class="mt-8 flex flex-wrap gap-3">
                <x-ui.button :href="route('contact')" variant="light" size="lg">{{ __('Falar connosco') }}</x-ui.button>
                <a href="mailto:hello@asfouri.media" class="inline-flex items-center gap-2 rounded-full border border-parchment/40 px-7 py-3.5 text-base font-semibold text-parchment transition hover:bg-parchment/10">
                    hello@asfouri.media
                </a>
            </div>
        </div>
    </div>
</section>
