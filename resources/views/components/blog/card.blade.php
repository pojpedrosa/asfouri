@props(['post'])

<article class="reveal group flex flex-col overflow-hidden rounded-3xl border border-cream-deep bg-paper transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <a href="{{ route('blog.show', $post) }}" class="block" tabindex="-1" aria-hidden="true">
        @if ($post->coverUrl())
            <img src="{{ $post->coverUrl() }}" alt="" class="aspect-[16/10] w-full object-cover" />
        @else
            <div class="relative flex aspect-[16/10] items-center justify-center overflow-hidden bg-blue-500">
                <span class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-sun/30" aria-hidden="true"></span>
                <span class="pointer-events-none absolute -bottom-8 left-6 h-16 w-16 rounded-full bg-blue-400/40" aria-hidden="true"></span>
                <x-brand.mark class="relative h-14 w-auto text-cream" />
            </div>
        @endif
    </a>
    <div class="flex flex-1 flex-col p-6">
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-blue-400">
            {{ $post->published_at?->locale(app()->getLocale())->isoFormat('LL') }}
            <span class="text-ink/30">·</span>
            {{ $post->readingMinutes() }} {{ __('min de leitura') }}
        </p>
        <h3 class="mt-3 font-display text-xl font-semibold leading-snug text-ink">
            <a href="{{ route('blog.show', $post) }}" class="transition-colors hover:text-blue-500">{{ $post->title() }}</a>
        </h3>
        @if ($post->excerpt())
            <p class="mt-2 text-pretty text-sm leading-relaxed text-ink/70">{{ $post->excerpt() }}</p>
        @endif
        <a href="{{ route('blog.show', $post) }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-500" tabindex="-1" aria-hidden="true">
            {{ __('Ler artigo') }}
            <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-0.5" />
        </a>
    </div>
</article>
