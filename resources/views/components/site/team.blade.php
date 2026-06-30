@php
    $members = \App\Models\TeamMember::published()->get();
    if ($members->isEmpty()) {
        return;
    }
    $section = \App\Models\TeamSection::current();
@endphp

<section class="relative overflow-hidden bg-cream py-20 sm:py-28">
    {{-- decorative brand accents --}}
    <span class="pointer-events-none absolute -left-20 top-12 h-56 w-56 rounded-full bg-sun/40 blur-0" aria-hidden="true"></span>
    <span class="pointer-events-none absolute right-8 top-24 hidden h-10 w-10 rounded-full bg-coral/70 lg:block" aria-hidden="true"></span>
    <span class="pointer-events-none absolute -right-16 bottom-10 h-40 w-40 rounded-full bg-sky/40" aria-hidden="true"></span>
    <span class="pointer-events-none absolute bottom-20 left-1/4 hidden h-3 w-3 rounded-full bg-gold lg:block" aria-hidden="true"></span>

    <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
        {{-- section header --}}
        <div class="max-w-2xl">
            @if ($section->eyebrow())
                <x-ui.eyebrow>{{ $section->eyebrow() }}</x-ui.eyebrow>
            @endif
            @if ($section->heading())
                <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">
                    {{ $section->heading() }}
                </h2>
            @endif
            @if ($section->intro())
                <p class="mt-5 max-w-xl text-pretty text-lg leading-relaxed text-ink/70">
                    {{ $section->intro() }}
                </p>
            @endif
        </div>

        {{-- member grid --}}
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($members as $member)
                <div class="reveal group relative overflow-hidden rounded-3xl border border-cream-deep bg-paper p-7 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    {{-- soft sun corner accent --}}
                    <span class="pointer-events-none absolute -right-8 -top-8 h-20 w-20 rounded-full bg-sun/40 transition-transform duration-300 group-hover:scale-110" aria-hidden="true"></span>

                    {{-- photo / fallback --}}
                    <div class="relative">
                        @if ($member->photoUrl())
                            <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}"
                                 class="h-20 w-20 rounded-full object-cover ring-2 ring-cream-deep" />
                        @else
                            <span class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-blue-50" aria-hidden="true">
                                <x-brand.mark class="h-10 w-auto text-blue-500" />
                            </span>
                        @endif
                    </div>

                    {{-- name --}}
                    <h3 class="relative mt-5 font-display text-xl font-semibold text-blue-500">{{ $member->name }}</h3>

                    {{-- role --}}
                    @if ($member->role())
                        <p class="relative mt-1 text-sm font-medium text-ink/60">{{ $member->role() }}</p>
                    @endif

                    {{-- bio --}}
                    @if ($member->bio())
                        <p class="relative mt-3 whitespace-pre-line text-sm leading-relaxed text-ink/70">{{ $member->bio() }}</p>
                    @endif

                    {{-- socials --}}
                    @if (count($member->socials()))
                        <div class="relative mt-5 flex flex-wrap items-center gap-2">
                            @foreach ($member->socials() as $social)
                                <a href="{{ $social['url'] }}"
                                   @if ($social['key'] !== 'email') target="_blank" @endif
                                   rel="noopener"
                                   aria-label="{{ $social['label'] }}"
                                   class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-500 transition hover:bg-blue-500 hover:text-cream">
                                    <x-ui.icon :name="$social['icon']" class="h-5 w-5" />
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
