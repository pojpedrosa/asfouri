<x-layouts.site :title="__('Abordagem')" :description="__('O nosso manifesto: comunicação regenerativa que multiplica o que há de bom no mundo, com profundidade em vez de alcance, consentimento e criatividade humana.')">
    <x-site.page-hero
        :eyebrow="__('Abordagem · Manifesto')"
        :title="__('A comunicação também pode regenerar')"
        :intro="__('Não se constrói um mundo regenerativo com comunicação extrativa. A forma como comunicamos tem de encarnar o mundo que queremos ver.')" />

    {{-- Manifesto statement — electric blue on cream --}}
    <section class="relative overflow-hidden">
        {{-- playful geometric punctuation --}}
        <span class="pointer-events-none absolute -right-16 top-10 hidden h-64 w-64 rounded-full bg-sun/50 blur-0 sm:block" aria-hidden="true"></span>
        <span class="pointer-events-none absolute right-24 top-44 hidden h-10 w-10 rounded-full bg-coral sm:block" aria-hidden="true"></span>

        <div class="relative mx-auto max-w-4xl px-5 py-20 sm:px-8 sm:py-28">
            <p class="reveal font-display text-3xl font-semibold leading-[1.1] tracking-tight text-balance text-blue-500 sm:text-5xl">
                {{ __('Existimos para') }}
                <span class="ink-underline box-decoration-clone">{{ __('multiplicar o que já há de bom no mundo') }}</span>
                {{ __('— e amplificá-lo sem esgotar ninguém.') }}
            </p>
            <p class="reveal mt-8 max-w-2xl text-pretty text-lg leading-relaxed text-ink/80">
                {{ __('Há organizações a fazer um trabalho que muda o mundo, mas cuja mensagem não chega a quem devia. O nosso trabalho é torná-la mais alta — com profundidade, consentimento e cuidado — para que as boas ideias enraízem e levantem voo.') }}
            </p>
            <p class="reveal mt-5 max-w-2xl text-pretty text-lg leading-relaxed text-ink/80">
                {{ __('Recusamos a agressividade, a manipulação e o ruído. O método tem de ser igual ao destino: regenerativo do princípio ao fim.') }}
            </p>
        </div>
    </section>

    {{-- Extractive vs Regenerative — bold blue section --}}
    <section class="relative overflow-hidden bg-blue-500 py-20 text-cream sm:py-28">
        {{-- white sparrow as punctuation --}}
        <x-brand.mark class="animate-drift pointer-events-none absolute -right-6 top-6 h-44 w-auto text-cream/10 sm:h-64" />

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-sun">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-sun"></span>{{ __('Duas formas de comunicar') }}
                </span>
                <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-paper sm:text-5xl">{{ __('Do extrativo ao regenerativo') }}</h2>
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
            <div class="mt-12 grid gap-5 sm:grid-cols-2">
                {{-- Extractive --}}
                <div class="rounded-3xl border border-cream/15 bg-blue-700/40 p-7 sm:p-8">
                    <h3 class="font-display text-xl font-medium text-sky">{{ __('Comunicação extrativa') }}</h3>
                    <ul class="mt-6 space-y-3.5">
                        @foreach ($contrast as $c)
                            <li class="flex items-start gap-3 text-sm text-cream/70">
                                <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-cream/10 text-coral">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><path d="M6 12h12"/></svg>
                                </span>{{ $c['from'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Regenerative --}}
                <div class="rounded-3xl bg-paper p-7 text-ink shadow-xl sm:p-8">
                    <h3 class="font-display text-xl font-semibold text-blue-500">{{ __('Comunicação regenerativa') }}</h3>
                    <ul class="mt-6 space-y-3.5">
                        @foreach ($contrast as $c)
                            <li class="flex items-start gap-3 text-sm font-medium text-ink/90">
                                <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-blue-500 text-cream">
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
            <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">{{ __('Seis raízes que sustentam tudo') }}</h2>
        </div>

        @php
            $principles = [
                ['n' => '01', 'title' => __('Profundidade'),      'text' => __('Damos ênfase à profundidade das ligações, e não ao número de impressões. Trabalhamos uma comunicação com impacto, que fica na memória e permanece acessível.')],
                ['n' => '02', 'title' => __('Regeneração'),       'text' => __('Criamos modelos de comunicação centrados na longevidade e na restauração, moldados e adaptados pelas comunidades que alcançam e que os inspiram.')],
                ['n' => '03', 'title' => __('Centrado no humano'),'text' => __('Valorizamos e trabalhamos com artistas e criações originais, recusando ceder a um mundo que se achata na uniformidade da IA.')],
                ['n' => '04', 'title' => __('Consentimento'),     'text' => __('Gerimos a comunicação com permissão e escuta ativa das comunidades, parceiros e partes interessadas envolvidas.')],
                ['n' => '05', 'title' => __('Adaptação'),         'text' => __('As ferramentas e os formatos de comunicação adaptam-se a cada projeto e às comunidades e públicos envolvidos. Não assumimos os canais convencionais como os únicos e mais eficazes para amplificar.')],
                ['n' => '06', 'title' => __('Tecnologia'),        'text' => __('Usamos a tecnologia e a IA como ferramenta, com uma só pergunta no centro: isto serve as pessoas e o planeta? Se não servir, não entra.')],
            ];
        @endphp

        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($principles as $p)
                <div class="reveal group relative overflow-hidden rounded-3xl border border-cream-deep bg-paper p-7 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <span class="font-wordmark text-5xl leading-none text-sky transition-colors group-hover:text-coral">{{ $p['n'] }}</span>
                    <h3 class="mt-4 font-display text-xl font-semibold text-blue-500">{{ $p['title'] }}</h3>
                    <p class="mt-2 text-pretty text-sm leading-relaxed text-ink/70">{{ $p['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Pull quote — the bird with the sun --}}
    <section class="bg-cream-deep py-20 sm:py-24">
        <div class="mx-auto max-w-4xl px-5 text-center sm:px-8">
            <x-brand.mark :sun="true" class="mx-auto h-16 w-auto text-blue-500" />
            <blockquote class="mt-8 font-display text-3xl font-semibold leading-[1.15] tracking-tight text-balance text-blue-500 sm:text-4xl">
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
