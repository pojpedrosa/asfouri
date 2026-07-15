<x-layouts.site :title="$post->title()" :description="$post->excerpt() ?? ''">
    <article>
        <x-site.page-hero :eyebrow="__('Jornal')" :title="$post->title()">
            <p class="mt-6 flex flex-wrap items-center gap-2 text-sm font-medium text-ink/60">
                <span>{{ $post->published_at?->locale(app()->getLocale())->isoFormat('LL') }}</span>
                <span class="text-ink/30">·</span>
                <span>{{ $post->readingMinutes() }} {{ __('min de leitura') }}</span>
                @if ($post->author_name)
                    <span class="text-ink/30">·</span>
                    <span>{{ $post->author_name }}</span>
                @endif
            </p>
        </x-site.page-hero>

        @if ($post->coverUrl())
            <figure class="mx-auto max-w-4xl px-5 sm:px-8">
                <img src="{{ $post->coverUrl() }}" alt="" class="mt-10 aspect-[16/9] w-full rounded-3xl object-cover shadow-sm" />
                @if ($post->cover_credit)
                    <figcaption class="mt-2 text-right text-xs text-ink/50">{{ $post->cover_credit }}</figcaption>
                @endif
            </figure>
        @endif

        <div class="mx-auto max-w-3xl px-5 py-14 sm:px-8 sm:py-20">
            <div class="prose prose-lg prose-neutral max-w-none prose-headings:font-display prose-headings:font-semibold prose-headings:tracking-tight prose-headings:text-blue-700 prose-a:text-blue-500 prose-strong:text-ink prose-p:text-ink/80 prose-li:text-ink/80">
                {!! $post->body() !!}
            </div>

            <div class="mt-14 border-t border-cream-deep pt-8">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-500 transition hover:text-blue-700">
                    <x-ui.icon name="arrow" class="h-4 w-4 rotate-180" />
                    {{ __('Voltar ao jornal') }}
                </a>
            </div>
        </div>
    </article>

    @if ($more->isNotEmpty())
        <section class="bg-cream-deep py-16 sm:py-20">
            <div class="mx-auto max-w-7xl px-5 sm:px-8">
                <x-ui.eyebrow>{{ __('Continuar a ler') }}</x-ui.eyebrow>
                <div class="mt-8 grid gap-6 sm:grid-cols-3">
                    @foreach ($more as $p)
                        <x-blog.card :post="$p" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="py-20 sm:py-24">
        <x-site.cta />
    </div>
</x-layouts.site>
