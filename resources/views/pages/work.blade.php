<x-layouts.site :title="__('Projetos')" :description="__('Os primeiros projetos da asfouri estão a germinar. Veja o tipo de trabalho que fazemos e seja um dos primeiros.')">
    <x-site.page-hero
        :eyebrow="__('Projetos')"
        :title="__('O nosso portefólio está a germinar')"
        :intro="__('A asfouri é jovem e seletiva. Em vez de encher esta página, escolhemos a dedo os projetos com que trabalhamos. Aqui mostraremos, em breve, o que vamos cultivando.')" />

    {{-- Types of work --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-24">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('O que fazemos crescer') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">{{ __('Tipos de projeto') }}</h2>
            <p class="mt-4 text-pretty text-soil-600">{{ __('Uma amostra do trabalho que adoramos abraçar — do digital ao físico, da estratégia à colheita.') }}</p>
        </div>

        @php
            $samples = [
                ['tag' => __('Marca + Web'),        'title' => __('Identidade e plataforma para uma quinta regenerativa'),       'text' => __('Da nova marca à loja online de cabazes, com mapa de produtores e área de membros.'), 'tone' => 'moss'],
                ['tag' => __('Comunicação'),        'title' => __('Estratégia e narrativa para um movimento de soberania alimentar'), 'text' => __('Mensagens-chave, plano editorial e campanha de mobilização cuidada.'), 'tone' => 'clay'],
                ['tag' => __('Social + Conteúdo'),  'title' => __('Gestão de redes para uma associação de conservação'),          'text' => __('Comunidade ativa, conteúdo de campo e relatórios de impacto trimestrais.'), 'tone' => 'wheat'],
                ['tag' => __('Offline'),            'title' => __('Editorial e exposição para um centro de educação ambiental'),  'text' => __('Publicação, sinalética e instalação imersiva sobre o ciclo da água.'), 'tone' => 'dawn'],
                ['tag' => __('IA + Plataforma'),    'title' => __('Assistente de conhecimento para uma rede de cooperativas'),    'text' => __('Base de conhecimento partilhada com pesquisa assistida por IA e revisão humana.'), 'tone' => 'moss'],
                ['tag' => __('Ilustração'),         'title' => __('Sistema de ilustração para uma marca de alimentos vivos'),     'text' => __('Família de ilustrações originais para embalagem, web e redes.'), 'tone' => 'clay'],
            ];
            $tones = [
                'moss'  => 'from-moss-200 to-moss-100 text-moss-800',
                'clay'  => 'from-clay-100 to-wheat-100 text-clay-800',
                'wheat' => 'from-wheat-100 to-wheat-50 text-wheat-600',
                'dawn'  => 'from-dawn-200 to-dawn-100 text-dawn-500',
            ];
        @endphp

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($samples as $s)
                <article class="reveal group flex flex-col overflow-hidden rounded-2xl border border-soil-100 bg-parchment">
                    <div class="grain relative flex aspect-[16/10] items-end overflow-hidden bg-gradient-to-br {{ $tones[$s['tone']] }} p-5">
                        <svg class="pointer-events-none absolute -right-4 -top-4 h-24 w-24 opacity-40" viewBox="0 0 48 72" fill="currentColor" aria-hidden="true">
                            <path d="M24 31 C30 28 38 19 41 9 C32 11 26 20 24 31 Z"/>
                            <path d="M24 37 C18 35 12 29 9 22 C16 23 21 29 24 37 Z"/>
                        </svg>
                        <span class="relative rounded-full bg-parchment/80 px-3 py-1 text-xs font-semibold tracking-wide text-soil-700 backdrop-blur">{{ $s['tag'] }}</span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="font-display text-xl leading-snug text-soil-900">{{ $s['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-soil-600">{{ $s['text'] }}</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-soil-400">
                            <span class="inline-block h-1.5 w-1.5 rounded-full bg-moss-400"></span>{{ __('Em breve') }}
                        </span>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="mt-10 max-w-xl text-sm text-soil-500">
            {{ __('Os exemplos acima são ilustrativos do nosso âmbito de trabalho. Os casos reais surgirão aqui à medida que crescem.') }}
        </p>
    </section>

    {{-- Be first --}}
    <div class="py-10 sm:py-16">
        <x-site.cta
            :eyebrow="__('Primeira colheita')"
            :heading="__('Seja um dos nossos primeiros projetos')"
            :text="__('Procuramos um punhado de parceiros para crescer com cuidado. Se está a regenerar algo, adorávamos conhecer.')" />
    </div>
</x-layouts.site>
