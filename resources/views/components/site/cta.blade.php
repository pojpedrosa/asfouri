@props([
    'eyebrow' => null,
    'heading' => null,
    'text' => null,
])

<section class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="relative overflow-hidden rounded-3xl bg-blue-500 px-6 py-16 text-cream sm:px-12 sm:py-20">
        {{-- playful geometric suns + the drifting sparrow --}}
        <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full bg-sun/20" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-12 right-24 hidden h-28 w-28 rounded-full bg-coral/25 sm:block" aria-hidden="true"></div>
        <x-brand.mark class="animate-drift pointer-events-none absolute right-8 top-8 h-32 w-auto text-cream/15 sm:right-16" />

        <div class="relative max-w-2xl">
            @if ($eyebrow)
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-sun">{{ $eyebrow }}</span>
            @endif
            <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight text-balance sm:text-5xl">
                {{ $heading ?? __('Vamos plantar algo juntos?') }}
            </h2>
            @if ($text !== false)
                <p class="mt-5 max-w-xl text-pretty text-cream/85 sm:text-lg">
                    {{ $text ?? __('Conte-nos o que está a cultivar. Respondemos a cada mensagem com atenção e sem pressa.') }}
                </p>
            @endif
            <div class="mt-8 flex flex-wrap gap-3">
                <x-ui.button :href="route('contact')" variant="light" size="lg">{{ __('Falar connosco') }}</x-ui.button>
                <a href="mailto:hello@asfouri.media" class="inline-flex items-center gap-2 rounded-full border border-cream/40 px-7 py-3.5 text-base font-semibold text-cream transition hover:bg-cream/10">
                    hello@asfouri.media
                </a>
            </div>
        </div>
    </div>
</section>
