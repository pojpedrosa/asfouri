<x-layouts.site>
    {{-- ─────────────────────────── Hero ─────────────────────────── --}}
    <section class="grain relative overflow-hidden">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 pb-16 pt-12 sm:px-8 lg:grid-cols-[1.05fr_0.95fr] lg:pb-24 lg:pt-20">
            <div>
                <x-ui.eyebrow>{{ __('Agência de comunicação regenerativa') }}</x-ui.eyebrow>
                <h1 class="mt-6 font-display text-5xl font-medium leading-[0.98] text-balance text-soil-900 sm:text-6xl lg:text-7xl">
                    {{ __('Comunicação que ganha raízes e') }}
                    <span class="italic text-clay-600">{{ __('levanta voo') }}</span>.
                </h1>
                <p class="mt-7 max-w-xl text-pretty text-lg leading-relaxed text-soil-700">
                    {{ __('A asfouri ajuda projetos regenerativos a contar a sua história — com estratégia, design, tecnologia e cuidado. Da terra ao ecrã, e de volta à terra.') }}
                </p>
                <div class="mt-9 flex flex-wrap items-center gap-3">
                    <x-ui.button :href="route('services')" size="lg">{{ __('Ver o que fazemos') }}</x-ui.button>
                    <x-ui.button :href="route('approach')" variant="outline" size="lg">{{ __('A nossa abordagem') }}</x-ui.button>
                </div>

                <dl class="mt-14 grid max-w-lg grid-cols-3 gap-6 border-t border-soil-200 pt-8">
                    <div>
                        <dt class="font-display text-3xl text-clay-600">100%</dt>
                        <dd class="mt-1 text-sm text-soil-600">{{ __('Projetos com propósito regenerativo') }}</dd>
                    </div>
                    <div>
                        <dt class="font-display text-3xl text-clay-600">7</dt>
                        <dd class="mt-1 text-sm text-soil-600">{{ __('Disciplinas, uma só raiz') }}</dd>
                    </div>
                    <div>
                        <dt class="font-display text-3xl text-clay-600">PT·EN</dt>
                        <dd class="mt-1 text-sm text-soil-600">{{ __('Trabalho em dois idiomas') }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Hero artwork: soil strata + sprout + bird --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="blob grain relative aspect-[4/5] w-full overflow-hidden bg-gradient-to-b from-wheat-100 via-clay-100 to-moss-200">
                    <svg class="absolute inset-0 h-full w-full" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none" aria-hidden="true">
                        {{-- soil horizons --}}
                        <path d="M0 330 C80 312 150 348 220 330 C300 310 350 340 400 326 L400 500 L0 500 Z" fill="#b3936a"/>
                        <path d="M0 372 C90 356 160 388 240 372 C310 358 360 384 400 370 L400 500 L0 500 Z" fill="#8f6c45"/>
                        <path d="M0 420 C100 408 180 432 260 420 C330 410 370 430 400 422 L400 500 L0 500 Z" fill="#573c24"/>
                        {{-- dotted seeds / organisms in soil --}}
                        <g fill="#f5efe1" opacity="0.55">
                            <circle cx="70" cy="400" r="3"/><circle cx="140" cy="440" r="2.5"/>
                            <circle cx="210" cy="402" r="3"/><circle cx="300" cy="446" r="2.5"/>
                            <circle cx="350" cy="408" r="3"/><circle cx="120" cy="470" r="2"/>
                            <circle cx="250" cy="466" r="2.5"/>
                        </g>
                        {{-- roots --}}
                        <path d="M200 330 C198 360 190 380 176 404 M200 330 C204 362 214 384 230 408 M200 330 L200 420"
                              stroke="#3a2817" stroke-width="2.4" stroke-linecap="round" opacity="0.65"/>
                        {{-- stem + leaves --}}
                        <path d="M200 330 C200 280 198 240 200 196" stroke="#42512c" stroke-width="6" stroke-linecap="round"/>
                        <path d="M200 250 C170 244 142 220 128 188 C166 190 192 214 200 250 Z" fill="#6c8341"/>
                        <path d="M200 226 C232 218 262 192 276 158 C236 162 210 188 200 226 Z" fill="#859d54"/>
                        <path d="M200 200 C182 196 165 180 158 160 C180 162 196 178 200 200 Z" fill="#546735"/>
                        {{-- the bird, asfouri --}}
                        <g class="animate-drift" transform="translate(250 120)">
                            <path d="M0 18 C6 8 18 4 30 8 C36 10 40 14 42 20 L52 14 C52 20 48 24 42 26 C44 34 38 42 28 44 C14 46 2 38 0 24 Z" fill="#432d1b"/>
                            <circle cx="34" cy="17" r="2" fill="#f5efe1"/>
                            <path d="M52 14 L62 11 L54 19 Z" fill="#c05a36"/>
                            <path d="M10 24 C16 22 24 22 30 26" stroke="#f5efe1" stroke-width="1.6" stroke-linecap="round" opacity="0.7"/>
                        </g>
                        {{-- sun --}}
                        <circle cx="92" cy="96" r="34" fill="#e6b454" opacity="0.7"/>
                    </svg>
                </div>
                <div class="absolute -bottom-5 -left-4 hidden rounded-2xl bg-parchment px-5 py-4 shadow-lg ring-1 ring-soil-100 sm:block">
                    <p class="font-display text-lg text-soil-900">{{ __('Solo vivo,') }}</p>
                    <p class="-mt-1 font-display text-lg italic text-clay-600">{{ __('histórias vivas.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Manifesto teaser ─────────────────────────── --}}
    <section class="mx-auto max-w-5xl px-5 py-20 text-center sm:px-8 sm:py-28">
        <x-ui.eyebrow class="justify-center">{{ __('O que é comunicação regenerativa') }}</x-ui.eyebrow>
        <p class="reveal mx-auto mt-7 max-w-3xl font-display text-2xl font-light leading-snug text-balance text-soil-800 sm:text-4xl">
            {{ __('Comunicar não é extrair atenção. É devolver mais do que se recebe — às pessoas, às comunidades e aos ecossistemas que tocamos.') }}
        </p>
        <p class="reveal mx-auto mt-6 max-w-2xl text-pretty leading-relaxed text-soil-600">
            {{ __('Inspiramo-nos na agricultura regenerativa: começar pelo solo, trabalhar com os ciclos naturais, cultivar diversidade e deixar o terreno mais fértil do que o encontrámos. Aplicamos os mesmos princípios à comunicação, ao design e à tecnologia.') }}
        </p>
        <div class="mt-9">
            <x-ui.button :href="route('approach')" variant="ghost">{{ __('Ler o manifesto') }} →</x-ui.button>
        </div>
    </section>

    {{-- ─────────────────────────── Services ─────────────────────────── --}}
    <section class="bg-parchment-deep py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-2xl">
                    <x-ui.eyebrow>{{ __('Serviços') }}</x-ui.eyebrow>
                    <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">
                        {{ __('Sete disciplinas, uma só raiz') }}
                    </h2>
                    <p class="mt-4 max-w-xl text-pretty text-soil-600">
                        {{ __('Do primeiro rascunho da estratégia ao código que sustenta a plataforma — cuidamos de toda a comunicação do seu projeto.') }}
                    </p>
                </div>
                <x-ui.button :href="route('services')" variant="outline" class="self-start sm:self-auto">{{ __('Todos os serviços') }}</x-ui.button>
            </div>

            @php
                $services = [
                    ['icon' => 'comms',    'title' => __('Comunicação regenerativa'),        'text' => __('Estratégia e narrativa que dão voz ao impacto real do seu projeto, sem greenwashing.'), 'anchor' => 'comunicacao'],
                    ['icon' => 'social',   'title' => __('Gestão de redes sociais'),          'text' => __('Presença digital cultivada com ritmo humano: comunidade em vez de vaidade.'), 'anchor' => 'redes'],
                    ['icon' => 'web',      'title' => __('Aplicações e plataformas web'),     'text' => __('Sites, plataformas e ferramentas sob medida, rápidas, acessíveis e sustentáveis.'), 'anchor' => 'plataformas'],
                    ['icon' => 'offline',  'title' => __('Componente offline'),               'text' => __('Editorial, impressão, sinalética, instalações e eventos — comunicação que se toca.'), 'anchor' => 'offline'],
                    ['icon' => 'ai',       'title' => __('IA como ferramenta regenerativa'),  'text' => __('Fluxos com inteligência artificial ao serviço das pessoas, com critério e transparência.'), 'anchor' => 'ia'],
                    ['icon' => 'branding', 'title' => __('Branding e ilustração'),             'text' => __('Identidades vivas e ilustração feita à mão que tornam a sua marca inconfundível.'), 'anchor' => 'branding'],
                    ['icon' => 'brand',    'title' => __('Gestão de marca'),                  'text' => __('Acompanhamento contínuo para a marca crescer coerente ao longo das estações.'), 'anchor' => 'marca'],
                ];
            @endphp

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $i => $s)
                    <a href="{{ route('services') }}#{{ $s['anchor'] }}"
                       @class([
                           'reveal group flex flex-col rounded-2xl border border-soil-100 bg-parchment p-7 transition duration-300 hover:-translate-y-1 hover:border-clay-200 hover:shadow-lg',
                           'lg:col-span-1' => true,
                           'sm:col-span-2 lg:col-span-1' => $i === 6,
                       ])>
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-moss-100 text-moss-700 transition group-hover:bg-clay-100 group-hover:text-clay-600">
                            <x-icon :name="$s['icon']" class="h-6 w-6" />
                        </span>
                        <h3 class="mt-5 font-display text-xl font-medium text-soil-900">{{ $s['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-soil-600">{{ $s['text'] }}</p>
                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-clay-600">
                            {{ __('Saber mais') }}
                            <x-icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-0.5" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Principles (dark soil) ─────────────────────────── --}}
    <section class="relative bg-soil-900 py-20 text-soil-100 sm:py-28">
        <div class="grain mx-auto max-w-7xl px-5 sm:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-wheat-300">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-wheat-400"></span>{{ __('Princípios') }}
                </span>
                <h2 class="mt-5 font-display text-4xl font-medium text-balance text-parchment sm:text-5xl">
                    {{ __('Cultivamos como quem cuida do solo') }}
                </h2>
            </div>

            @php
                $principles = [
                    ['n' => '01', 'title' => __('Começar pelo solo'),     'text' => __('Antes da campanha, a escuta. Entendemos o terreno — público, contexto e propósito — antes de plantar.')],
                    ['n' => '02', 'title' => __('Devolver mais'),         'text' => __('Cada peça deve regenerar atenção, confiança e relação, em vez de a esgotar.')],
                    ['n' => '03', 'title' => __('Trabalhar com as estações'), 'text' => __('Respeitamos o tempo certo de cada projeto. Crescimento saudável não tem atalhos.')],
                    ['n' => '04', 'title' => __('Diversidade gera resiliência'), 'text' => __('Misturamos disciplinas, vozes e formatos. A monocultura empobrece; a policultura floresce.')],
                    ['n' => '05', 'title' => __('Transparência radical'),  'text' => __('Comunicamos o que é real. Sem greenwashing, sem promessas que a terra não sustenta.')],
                    ['n' => '06', 'title' => __('Tecnologia a favor da vida'), 'text' => __('Ferramentas — IA incluída — só fazem sentido se servirem pessoas e ecossistemas.')],
                ];
            @endphp

            <div class="mt-14 grid gap-x-10 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($principles as $p)
                    <div class="reveal border-t border-soil-700 pt-5">
                        <span class="font-display text-2xl text-wheat-300">{{ $p['n'] }}</span>
                        <h3 class="mt-3 font-display text-xl text-parchment">{{ $p['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-soil-200">{{ $p['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Process ─────────────────────────── --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('Como trabalhamos') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">
                {{ __('Da semente à colheita') }}
            </h2>
        </div>

        @php
            $process = [
                ['icon' => 'listen',    'step' => __('Escutar'),   'text' => __('Imersão no seu projeto, território e comunidade. Mapeamos o que já vive aqui.')],
                ['icon' => 'root',      'step' => __('Enraizar'),  'text' => __('Estratégia, posicionamento e identidade. Definimos as raízes que tudo o resto sustenta.')],
                ['icon' => 'cultivate', 'step' => __('Cultivar'),  'text' => __('Design, conteúdo, código e produção. Construímos com método e cuidado artesanal.')],
                ['icon' => 'flourish',  'step' => __('Florescer'), 'text' => __('Lançamento, acompanhamento e medição honesta. Cuidamos para o impacto perdurar.')],
            ];
        @endphp

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($process as $i => $step)
                <div class="reveal relative rounded-2xl bg-moss-50 p-7">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-moss-600 text-parchment">
                        <x-icon :name="$step['icon']" class="h-6 w-6" />
                    </span>
                    <p class="mt-5 text-xs font-semibold uppercase tracking-[0.16em] text-moss-700">{{ sprintf('%02d', $i + 1) }}</p>
                    <h3 class="mt-1 font-display text-2xl text-soil-900">{{ $step['step'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-soil-600">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ─────────────────────────── Who we serve ─────────────────────────── --}}
    <section class="bg-parchment-deep py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div>
                    <x-ui.eyebrow>{{ __('Para quem') }}</x-ui.eyebrow>
                    <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">
                        {{ __('Quem semeia futuro') }}
                    </h2>
                    <p class="mt-5 max-w-md text-pretty leading-relaxed text-soil-600">
                        {{ __('Trabalhamos com quem regenera — a terra, as pessoas, a cultura. Se o seu projeto deixa o mundo melhor do que o encontrou, falamos a mesma língua.') }}
                    </p>
                    <div class="mt-8">
                        <x-ui.button :href="route('contact')">{{ __('Trabalhar connosco') }}</x-ui.button>
                    </div>
                </div>

                @php
                    $audiences = [
                        __('Agricultura regenerativa e agroecologia'),
                        __('Soberania alimentar e mercados locais'),
                        __('Conservação da natureza e biodiversidade'),
                        __('Energia, clima e transição justa'),
                        __('Educação, cultura e ciência'),
                        __('Economia social e cooperativas'),
                        __('Comunidades e movimentos de base'),
                        __('Empreendedorismo de impacto'),
                    ];
                @endphp
                <ul class="grid gap-3 sm:grid-cols-2">
                    @foreach ($audiences as $a)
                        <li class="reveal flex items-start gap-3 rounded-xl bg-parchment px-5 py-4 ring-1 ring-soil-100">
                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-moss-100 text-moss-700">
                                <x-icon name="leaf" class="h-4 w-4" />
                            </span>
                            <span class="text-sm font-medium text-soil-800">{{ $a }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── CTA ─────────────────────────── --}}
    <div class="py-20 sm:py-24">
        <x-site.cta />
    </div>
</x-layouts.site>
