<x-layouts.site :title="__('Abordagem')" :description="__('O nosso manifesto: comunicação regenerativa que multiplica o que há de bom no mundo, com profundidade em vez de alcance, consentimento e criatividade humana.')">
    <x-site.page-hero
        :eyebrow="__('Abordagem · Manifesto')"
        :title="__('A comunicação também pode regenerar')"
        :intro="__('Não se constrói um mundo regenerativo com comunicação extrativa. A forma como comunicamos tem de encarnar o mundo que queremos ver.')" />

    {{-- Manifesto statement --}}
    <section class="mx-auto max-w-4xl px-5 py-20 sm:px-8 sm:py-28">
        <p class="reveal font-display text-2xl font-light leading-snug text-balance text-soil-800 sm:text-4xl">
            {{ __('Existimos para') }}
            <span class="italic text-clay-600">{{ __('multiplicar o que já há de bom no mundo') }}</span>
            {{ __('— e amplificá-lo sem esgotar ninguém.') }}
        </p>
        <p class="reveal mt-8 max-w-2xl text-pretty text-lg leading-relaxed text-soil-600">
            {{ __('Há organizações a fazer um trabalho que muda o mundo, mas cuja mensagem não chega a quem devia. O nosso trabalho é torná-la mais alta — com profundidade, consentimento e cuidado — para que as boas ideias enraízem e levantem voo.') }}
        </p>
        <p class="reveal mt-5 max-w-2xl text-pretty text-lg leading-relaxed text-soil-600">
            {{ __('Recusamos a agressividade, a manipulação e o ruído. O método tem de ser igual ao destino: regenerativo do princípio ao fim.') }}
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
                    ['from' => __('Captar atenção a qualquer custo'),  'to' => __('Profundidade em vez de alcance')],
                    ['from' => __('Inundar de mensagens'),             'to' => __('Menos mensagens, mais profundas')],
                    ['from' => __('Otimizar para conversões'),         'to' => __('Conversões com sentido')],
                    ['from' => __('Intrusão sem permissão'),           'to' => __('Consentimento e escuta')],
                    ['from' => __('Esconder a mensagem no ruído'),     'to' => __('A mensagem em primeiro lugar')],
                    ['from' => __('Substituir pessoas por IA'),        'to' => __('Criatividade humana à frente')],
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

    {{-- Principles in depth (the pillars) --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('Os nossos princípios') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">{{ __('Seis raízes que sustentam tudo') }}</h2>
        </div>

        @php
            $principles = [
                ['n' => '01', 'title' => __('Profundidade acima do alcance'),  'text' => __('Chegar a menos pessoas, mas fundo. Uma relação verdadeira vale mais do que milhares de impressões que ninguém retém. É o princípio que mais defendemos.')],
                ['n' => '02', 'title' => __('Regenerar é mais eficaz'),         'text' => __('Largar a agressividade não é abdicar de resultados. Comunicação honesta gera mais ação real — e conversões com sentido — do que a manipulação.')],
                ['n' => '03', 'title' => __('Criatividade humana primeiro'),    'text' => __('Num mundo a achatar-se na repetição da IA, trazemos artistas e originalidade para a frente. A IA liberta tempo; as pessoas trazem a alma.')],
                ['n' => '04', 'title' => __('Consentimento, nunca intrusão'),   'text' => __('Comunicamos com permissão e escuta. Protegemos a relação das pessoas com os media, em vez de a desgastar.')],
                ['n' => '05', 'title' => __('Multiplicar o bem'),               'text' => __('Não inventamos o bem — encontramo-lo em quem já o faz e amplificamo-lo. Tornamos o bem mais alto e levamo-lo mais longe.')],
                ['n' => '06', 'title' => __('Tecnologia ao serviço da vida'),   'text' => __('Abraçamos novas ferramentas, IA incluída, com uma só pergunta: isto serve as pessoas e o planeta? Se não servir, não entra.')],
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
                {{ __('Tornamos o bem mais alto — e levamo-lo mais fundo. É este o trabalho.') }}
            </blockquote>
        </div>
    </section>

    <div class="py-20 sm:py-24">
        <x-site.cta
            :heading="__('Comunicar de outra forma é possível')"
            :text="__('Se reconhece o seu projeto nesta abordagem, vamos conversar sobre o que podemos cultivar juntos.')" />
    </div>
</x-layouts.site>
