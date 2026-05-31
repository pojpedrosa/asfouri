@props([
    'eyebrow' => null,
    'title' => '',
    'intro' => null,
])

<section class="grain relative overflow-hidden border-b border-soil-100">
    <div class="mx-auto max-w-7xl px-5 pb-14 pt-12 sm:px-8 lg:pb-20 lg:pt-20">
        @if ($eyebrow)
            <x-ui.eyebrow>{{ $eyebrow }}</x-ui.eyebrow>
        @endif
        <h1 class="mt-6 max-w-4xl font-display text-5xl font-medium leading-[1.0] text-balance text-soil-900 sm:text-6xl">
            {{ $title }}
        </h1>
        @if ($intro)
            <p class="mt-6 max-w-2xl text-pretty text-lg leading-relaxed text-soil-700">
                {{ $intro }}
            </p>
        @endif
        {{ $slot ?? '' }}
    </div>
</section>
