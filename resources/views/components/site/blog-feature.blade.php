@php
    $posts = \App\Models\Post::published()->limit(3)->get();
@endphp

@if ($posts->isNotEmpty())
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl">
                <x-ui.eyebrow>{{ __('Jornal') }}</x-ui.eyebrow>
                <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">
                    {{ __('Do nosso jornal') }}
                </h2>
                <p class="mt-4 max-w-xl text-pretty text-ink/70">
                    {{ __('Ideias e histórias sobre comunicação que regenera.') }}
                </p>
            </div>
            <x-ui.button :href="route('blog.index')" variant="outline" class="self-start sm:self-auto">{{ __('Todos os artigos') }}</x-ui.button>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <x-blog.card :post="$post" />
            @endforeach
        </div>
    </section>
@endif
