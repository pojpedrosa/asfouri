<x-layouts.site :title="__('Jornal')" :description="__('Notas e histórias sobre comunicação regenerativa, design, tecnologia e regeneração.')">
    <x-site.page-hero
        :eyebrow="__('Jornal')"
        :title="__('Notas do terreno')"
        :intro="__('Ideias, histórias e aprendizagens sobre comunicação que regenera — do primeiro rascunho à colheita.')" />

    <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 sm:py-24">
        @if ($posts->isEmpty())
            <div class="mx-auto max-w-xl text-center">
                <x-brand.mark :sun="true" class="mx-auto h-16 w-auto text-blue-500" />
                <h2 class="mt-6 font-display text-2xl font-semibold text-blue-500">{{ __('Ainda a germinar') }}</h2>
                <p class="mt-3 text-pretty text-ink/70">{{ __('Os primeiros artigos estão a caminho. Volte em breve.') }}</p>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <x-blog.card :post="$post" />
                @endforeach
            </div>

            @if ($posts->hasPages())
                <div class="mt-14">
                    {{ $posts->links() }}
                </div>
            @endif
        @endif
    </section>
</x-layouts.site>
