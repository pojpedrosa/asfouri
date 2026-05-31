<x-layouts.site :title="__('Abordagem')" :description="__('O que é comunicação regenerativa e como a praticamos: princípios vindos da agricultura regenerativa aplicados à comunicação, ao design e à tecnologia.')">
    <x-site.page-hero
        :eyebrow="__('Abordagem · Manifesto')"
        :title="__('A comunicação também pode regenerar')"
        :intro="__('Boa parte da comunicação trabalha como a agricultura industrial: extrai o máximo no menor tempo e deixa o terreno exausto. Acreditamos noutra forma de fazer.')" />

    {{-- Manifesto statement --}}
    <section class="mx-auto max-w-4xl px-5 py-20 sm:px-8 sm:py-28">
        <p class="reveal font-display text-2xl font-light leading-snug text-balance text-soil-800 sm:text-4xl">
            {{ __('Chamamos-lhe comunicação regenerativa:') }}
            <span class="italic text-clay-600">{{ __('comunicar de modo a devolver mais do que se recebe') }}</span>
            {{ __('— às pessoas, às comunidades e aos ecossistemas que tocamos.') }}
        </p>
        <p class="reveal mt-8 max-w-2xl text-pretty text-lg leading-relaxed text-soil-600">
            {{ __('Pegámos nos princípios da agricultura regenerativa — solo vivo, biodiversidade, ciclos, reciprocidade — e trouxemo-los para a comunicação, o design e a tecnologia. Não como metáfora bonita, mas como método de trabalho.') }}
        </p>
    </section>

    {{-- Extractive vs Regenerative --}}
    <section class="bg-soil-900 py-20 text-soil-100 sm:py-28">
        <div class="grain mx-auto max-w-7xl px-5 sm:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-wheat-300">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-wheat-400"></span>{{ __('Duas formas de comunicar') }}
                </span>
                <h2 class="mt-5 font-display text-4xl font-medium text-balance text-parchment sm:text-5xl">{{ __('Do extrativo ao regenerativo') }}</h2>
            </div>

            @php
                $contrast = [
                    ['from' => __('Captar atenção a qualquer custo'),        'to' => __('Cultivar atenção com respeito')],
                    ['from' => __('Falar para consumidores'),               'to' => __('Conversar com comunidades')],
                    ['from' => __('Picos de campanha e silêncio'),          'to' => __('Presença consistente, no tempo certo')],
                    ['from' => __('Métricas de vaidade'),                    'to' => __('Indicadores de relação e impacto')],
                    ['from' => __('Promessas maiores do que a realidade'),  'to' => __('Transparência sobre o que é real')],
                    ['from' => __('Descartável e em série'),                 'to' => __('Durável e feito à medida')],
                ];
            @endphp
            <div class="mt-12 grid gap-px overflow-hidden rounded-2xl bg-soil-700/40 sm:grid-cols-2">
                <div class="bg-soil-800/60 p-7">
                    <h3 class="font-display text-xl text-soil-200">{{ __('Comunicação extrativa') }}</h3>
                    <ul class="mt-5 space-y-3">
                        @foreach ($contrast as $c)
                            <li class="flex items-start gap-3 text-sm text-soil-300">
                                <span class="mt-1 text-clay-300">—</span>{{ $c['from'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-moss-800/40 p-7 ring-1 ring-moss-500/30">
                    <h3 class="font-display text-xl text-wheat-200">{{ __('Comunicação regenerativa') }}</h3>
                    <ul class="mt-5 space-y-3">
                        @foreach ($contrast as $c)
                            <li class="flex items-start gap-3 text-sm text-parchment">
                                <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-moss-500/30 text-moss-200">
                                    <x-ui.icon name="check" class="h-3 w-3" />
                                </span>{{ $c['to'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Principles in depth --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('Os nossos princípios') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">{{ __('Seis raízes que sustentam tudo') }}</h2>
        </div>

        @php
            $principles = [
                ['n' => '01', 'title' => __('Começar pelo solo'),     'text' => __('Antes de qualquer campanha, escutamos. Estudamos o público, o contexto e o propósito — porque nada saudável cresce em terreno que não se conhece.')],
                ['n' => '02', 'title' => __('Devolver mais do que se recebe'), 'text' => __('Medimos o sucesso pelo que deixamos para trás: mais confiança, mais relação, mais literacia. Comunicação que enriquece o terreno comum.')],
                ['n' => '03', 'title' => __('Trabalhar com as estações'), 'text' => __('Cada projeto tem o seu tempo. Preferimos crescimento saudável e duradouro a picos artificiais que esgotam pessoas e públicos.')],
                ['n' => '04', 'title' => __('Diversidade gera resiliência'), 'text' => __('Misturamos disciplinas, vozes e formatos. Como na natureza, a policultura é mais forte e mais bela do que a monocultura.')],
                ['n' => '05', 'title' => __('Transparência radical'),  'text' => __('Comunicamos o que é real e recusamos o greenwashing. A confiança é o húmus de qualquer relação que dure.')],
                ['n' => '06', 'title' => __('Tecnologia a favor da vida'), 'text' => __('Abraçamos novas ferramentas, IA incluída, com uma só pergunta: isto serve as pessoas e os ecossistemas? Se não servir, não entra.')],
            ];
        @endphp

        <div class="mt-14 grid gap-x-12 gap-y-10 sm:grid-cols-2">
            @foreach ($principles as $p)
                <div class="reveal flex gap-6 border-t border-soil-200 pt-6">
                    <span class="font-display text-3xl text-clay-500">{{ $p['n'] }}</span>
                    <div>
                        <h3 class="font-display text-2xl text-soil-900">{{ $p['title'] }}</h3>
                        <p class="mt-2 text-pretty leading-relaxed text-soil-600">{{ $p['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Pull quote --}}
    <section class="bg-parchment-deep py-20 sm:py-24">
        <div class="mx-auto max-w-4xl px-5 text-center sm:px-8">
            <x-brand.mark class="mx-auto h-14 w-auto text-moss-600" />
            <blockquote class="mt-8 font-display text-3xl font-light leading-snug text-balance text-soil-800 sm:text-4xl">
                {{ __('“Deixar o terreno mais fértil do que o encontrámos.” É esta a única métrica que nunca negociamos.') }}
            </blockquote>
        </div>
    </section>

    <div class="py-20 sm:py-24">
        <x-site.cta
            :heading="__('Comunicar de outra forma é possível')"
            :text="__('Se reconhece o seu projeto nesta abordagem, vamos conversar sobre o que podemos cultivar juntos.')" />
    </div>
</x-layouts.site>
