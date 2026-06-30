<x-layouts.site :title="__('Projetos')" :description="__('Os primeiros projetos da asfouri estão a germinar. Veja o tipo de trabalho que fazemos e seja um dos primeiros.')">
    <x-site.page-hero
        :eyebrow="__('Projetos')"
        :title="__('O nosso portefólio está a germinar')"
        :intro="__('A asfouri é jovem e seletiva. Em vez de encher esta página, escolhemos a dedo os projetos com que trabalhamos. Aqui mostraremos, em breve, o que vamos cultivando.')" />

    {{-- Types of work --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-24">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('O que fazemos crescer') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-semibold text-balance text-blue-500 sm:text-5xl">{{ __('Tipos de projeto') }}</h2>
            <p class="mt-4 text-pretty text-ink/70">{{ __('Uma amostra do trabalho que adoramos abraçar — do digital ao físico, da estratégia à colheita.') }}</p>
        </div>

        @php
            $samples = [
                ['tag' => __('Marca + Web'),        'title' => __('Identidade e plataforma para uma quinta regenerativa'),       'text' => __('Da nova marca à loja online de cabazes, com mapa de produtores e área de membros.'), 'tone' => 'blue'],
                ['tag' => __('Comunicação'),        'title' => __('Estratégia e narrativa para um movimento de soberania alimentar'), 'text' => __('Mensagens-chave, plano editorial e campanha de mobilização cuidada.'), 'tone' => 'coral'],
                ['tag' => __('Social + Conteúdo'),  'title' => __('Gestão de redes para uma associação de conservação'),          'text' => __('Comunidade ativa, conteúdo de campo e relatórios de impacto trimestrais.'), 'tone' => 'gold'],
                ['tag' => __('Offline'),            'title' => __('Editorial e exposição para um centro de educação ambiental'),  'text' => __('Publicação, sinalética e instalação imersiva sobre o ciclo da água.'), 'tone' => 'sky'],
                ['tag' => __('IA + Plataforma'),    'title' => __('Assistente de conhecimento para uma rede de cooperativas'),    'text' => __('Base de conhecimento partilhada com pesquisa assistida por IA e revisão humana.'), 'tone' => 'coral'],
                ['tag' => __('Ilustração'),         'title' => __('Sistema de ilustração para uma marca de alimentos vivos'),     'text' => __('Família de ilustrações originais para embalagem, web e redes.'), 'tone' => 'gold'],
            ];
            // Brand accent gradients for the card "cover". bird = sparrow colour on the field.
            $tones = [
                'blue'  => ['grad' => 'from-blue-500 to-blue-700',   'bird' => 'text-cream/70',      'chip' => 'text-blue-700'],
                'coral' => ['grad' => 'from-coral to-coral-soft',    'bird' => 'text-paper/80',      'chip' => 'text-coral'],
                'gold'  => ['grad' => 'from-gold to-sun',            'bird' => 'text-ink/30',        'chip' => 'text-gold'],
                'sky'   => ['grad' => 'from-sky to-sky-soft',        'bird' => 'text-blue-500/40',   'chip' => 'text-blue-700'],
            ];
        @endphp

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($samples as $s)
                @php $t = $tones[$s['tone']]; @endphp
                <article class="reveal group flex flex-col overflow-hidden rounded-2xl border border-cream-deep bg-paper transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="relative flex aspect-[16/10] items-end overflow-hidden bg-gradient-to-br {{ $t['grad'] }} p-5">
                        {{-- soft sun-circle accent --}}
                        <span class="pointer-events-none absolute -left-8 -bottom-8 h-28 w-28 rounded-full bg-paper/15" aria-hidden="true"></span>
                        {{-- the sparrow, asfouri --}}
                        <x-brand.mark class="animate-drift pointer-events-none absolute -right-2 -top-3 h-24 w-auto {{ $t['bird'] }}" />
                        <span class="relative rounded-full bg-paper/90 px-3 py-1 text-xs font-semibold tracking-wide {{ $t['chip'] }} backdrop-blur">{{ $s['tag'] }}</span>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="font-display text-xl font-semibold leading-snug text-ink">{{ $s['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink/70">{{ $s['text'] }}</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-blue-400">
                            <span class="inline-block h-1.5 w-1.5 rounded-full bg-gold"></span>{{ __('Em breve') }}
                        </span>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="mt-10 max-w-xl text-sm text-ink/60">
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
