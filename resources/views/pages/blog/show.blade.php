<x-layouts.site :title="$post->title()" :description="$post->excerpt()" :image="$post->coverUrl()" og-type="article">
    @php
        $articleLd = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title(),
            'description' => $post->excerpt(),
            'image' => [$post->coverUrl() ?: asset('brand/og-default.png')],
            'datePublished' => $post->published_at?->toIso8601String(),
            'dateModified' => ($post->updated_at ?? $post->published_at)?->toIso8601String(),
            'inLanguage' => app()->getLocale() === 'pt' ? 'pt-PT' : 'en-GB',
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('blog.show', $post)],
            'author' => [
                '@type' => ($post->author_name && $post->author_name !== 'asfouri') ? 'Person' : 'Organization',
                'name' => $post->author_name ?: 'asfouri',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'asfouri',
                'logo' => ['@type' => 'ImageObject', 'url' => asset('brand/asfouri-icon.svg')],
            ],
        ];
        $breadcrumbLd = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => __('Início'), 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => __('Jornal'), 'item' => route('blog.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title(), 'item' => route('blog.show', $post)],
            ],
        ];
    @endphp
    @push('head')
        <script type="application/ld+json">{!! json_encode($articleLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        <script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endpush

    <article>
        <x-site.page-hero :eyebrow="__('Jornal')" :title="$post->title()">
            <p class="mt-6 flex flex-wrap items-center gap-2 text-sm font-medium text-ink/60">
                <time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->locale(app()->getLocale())->isoFormat('LL') }}</time>
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
                <img src="{{ $post->coverUrl() }}" alt="{{ $post->title() }}" fetchpriority="high" class="mt-10 aspect-[16/9] w-full rounded-3xl object-cover shadow-sm" />
                @if (trim(strip_tags((string) $post->cover_credit)) !== '')
                    <figcaption class="mt-2 text-right text-xs text-ink/50 [&_p]:m-0 [&_a]:underline [&_a]:decoration-ink/30 [&_a]:underline-offset-2 [&_a]:transition-colors [&_a:hover]:text-blue-500">{!! $post->cover_credit !!}</figcaption>
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
