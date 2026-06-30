@props([
    'eyebrow' => null,
    'title' => '',
    'intro' => null,
])

<section class="relative overflow-hidden border-b border-cream-deep bg-cream">
    {{-- playful geometric accents: a rising sun + a sky circle --}}
    <div class="pointer-events-none absolute -right-16 -top-20 h-72 w-72 rounded-full bg-sun/60 blur-[2px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute right-32 top-24 h-14 w-14 rounded-full bg-coral/70" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-10 left-1/3 hidden h-24 w-24 rounded-full bg-sky/50 sm:block" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-7xl px-5 pb-14 pt-12 sm:px-8 lg:pb-20 lg:pt-20">
        @if ($eyebrow)
            <x-ui.eyebrow>{{ $eyebrow }}</x-ui.eyebrow>
        @endif
        <h1 class="mt-6 max-w-4xl font-display text-5xl font-semibold leading-[1.02] tracking-tight text-balance text-blue-500 sm:text-6xl">
            {{ $title }}
        </h1>
        @if ($intro)
            <p class="mt-6 max-w-2xl text-pretty text-lg leading-relaxed text-ink/80">
                {{ $intro }}
            </p>
        @endif
        {{ $slot ?? '' }}
    </div>
</section>
