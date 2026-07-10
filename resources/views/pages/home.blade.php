<x-layouts.site>
    {{-- ─────────────────────────── Hero ─────────────────────────── --}}
    <section class="relative overflow-hidden bg-cream">
        {{-- playful geometric accents --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-sun/45 blur-0"></div>
            <div class="absolute right-40 top-24 hidden h-16 w-16 rounded-full bg-coral/70 lg:block"></div>
            <div class="absolute -left-16 bottom-10 h-40 w-40 rounded-full bg-sky/50"></div>
        </div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-5 pb-16 pt-12 sm:px-8 lg:grid-cols-[1.05fr_0.95fr] lg:pb-24 lg:pt-20">
            <div>
                <x-ui.eyebrow>{{ __('Agência de comunicação regenerativa') }}</x-ui.eyebrow>
                <h1 class="mt-6 font-display text-5xl font-semibold leading-[0.98] tracking-tight text-balance text-blue-500 sm:text-6xl lg:text-7xl">
                    {{ __('Comunicação que ganha raízes e') }}
                    <span class="relative inline-block text-gold">{{ __('levanta voo') }}</span>.
                </h1>
                <p class="mt-7 max-w-xl text-pretty text-lg leading-relaxed text-ink/80">
                    {{ __('A asfouri multiplica o que há de bom no mundo: amplificamos as ideias, ferramentas e projetos de quem o trabalha a regenerar com profundidade, colaboração e criatividade humana.') }}
                </p>
                <div class="mt-9 flex flex-wrap items-center gap-3">
                    <x-ui.button :href="route('services')" size="lg">{{ __('Ver o que fazemos') }}</x-ui.button>
                    <x-ui.button :href="route('approach')" variant="outline" size="lg">{{ __('A nossa abordagem') }}</x-ui.button>
                </div>
            </div>

            {{-- Hero motif: the sparrow rising over a sun, with geometric shapes --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="relative aspect-square w-full">
                    {{-- big sun-circle behind the bird --}}
                    <div class="absolute left-1/2 top-1/2 h-[78%] w-[78%] -translate-x-1/2 -translate-y-1/2 rounded-full bg-sun"></div>
                    {{-- thin ring accent --}}
                    <div class="absolute left-1/2 top-1/2 h-[92%] w-[92%] -translate-x-1/2 -translate-y-1/2 rounded-full border-2 border-blue-500/15"></div>
                    {{-- small floating shapes --}}
                    <div class="absolute right-6 top-6 h-10 w-10 rounded-full bg-coral"></div>
                    <div class="absolute bottom-8 left-2 h-6 w-6 rounded-full bg-blue-500"></div>
                    <div class="absolute bottom-16 right-10 h-4 w-4 rounded-full bg-gold"></div>

                    {{-- the bird --}}
                    <x-brand.mark class="animate-drift absolute left-1/2 top-1/2 h-[56%] w-auto -translate-x-1/2 -translate-y-1/2 text-blue-500 drop-shadow-sm" />
                </div>

                <div class="absolute -bottom-3 -left-2 hidden rounded-2xl bg-paper px-5 py-4 shadow-lg ring-1 ring-blue-100 sm:block">
                    <p class="font-display text-lg font-semibold text-blue-500">{{ __('Solo vivo,') }}</p>
                    <p class="-mt-1 font-display text-lg font-medium text-gold">{{ __('histórias vivas.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Manifesto teaser ─────────────────────────── --}}
    <section class="mx-auto max-w-5xl px-5 py-20 text-center sm:px-8 sm:py-28">
        <x-ui.eyebrow class="justify-center">{{ __('O que é comunicação regenerativa') }}</x-ui.eyebrow>
        <p class="reveal mx-auto mt-7 max-w-3xl font-display text-2xl font-medium leading-snug text-balance text-blue-500 sm:text-4xl">
            {{ __('A comunicação não deve resumir-se a extrair atenção. A comunicação regenerativa privilegia as relações humanas e a relação com o nosso planeta.') }}
        </p>
        <p class="reveal mx-auto mt-6 max-w-2xl text-pretty leading-relaxed text-ink/70">
            {{ __('A comunicação é também uma parte integrante do processo de regeneração do nosso planeta. Uma comunicação regenerativa começa na transparência e no consentimento, recusa a agressividade e a extração, elimina a manipulação e cria mensagens mais profundas.') }}
        </p>
        <div class="mt-9">
            <x-ui.button :href="route('approach')" variant="ghost">{{ __('Ler o manifesto') }} →</x-ui.button>
        </div>
    </section>

    {{-- ─────────────────────────── Services ─────────────────────────── --}}
    <section class="bg-cream-deep py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-2xl">
                    <x-ui.eyebrow>{{ __('Serviços') }}</x-ui.eyebrow>
                    <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">
                        {{ __('Sete disciplinas, uma só raiz') }}
                    </h2>
                    <p class="mt-4 max-w-xl text-pretty text-ink/70">
                        {{ __('Do primeiro rascunho da estratégia ao código que sustenta a plataforma — cuidamos de toda a comunicação do seu projeto.') }}
                    </p>
                </div>
                <x-ui.button :href="route('services')" variant="outline" class="self-start sm:self-auto">{{ __('Todos os serviços') }}</x-ui.button>
            </div>

            @php
                $services = [
                    ['icon' => 'comms',    'title' => __('Estratégia e narrativa'),           'text' => __('Damos voz ao impacto real do seu projeto, sem greenwashing.'), 'anchor' => 'comunicacao'],
                    ['icon' => 'social',   'title' => __('Gestão de redes sociais'),          'text' => __('Presença digital cultivada com ritmo humano: comunidade em vez de vaidade.'), 'anchor' => 'redes'],
                    ['icon' => 'web',      'title' => __('Aplicações e plataformas web'),     'text' => __('Sites, plataformas e ferramentas sob medida, rápidas, acessíveis e sustentáveis.'), 'anchor' => 'plataformas'],
                    ['icon' => 'offline',  'title' => __('Componente offline'),               'text' => __('Editorial, impressão, sinalética, instalações e eventos — comunicação que se toca.'), 'anchor' => 'offline'],
                    ['icon' => 'ai',       'title' => __('IA como ferramenta regenerativa'),  'text' => __('Fluxos com inteligência artificial ao serviço das pessoas, com critério e transparência.'), 'anchor' => 'ia'],
                    ['icon' => 'branding', 'title' => __('Branding e ilustração'),             'text' => __('Identidades vivas e ilustração feita à mão que tornam a sua marca inconfundível.'), 'anchor' => 'branding'],
                    ['icon' => 'brand',    'title' => __('Gestão de marca'),                  'text' => __('Acompanhamento contínuo para a marca crescer coerente ao longo das estações.'), 'anchor' => 'marca'],
                ];
                $iconTints = [
                    'bg-blue-50 text-blue-500',
                    'bg-coral-soft/50 text-coral',
                    'bg-sky-soft text-blue-500',
                    'bg-sun/40 text-blue-700',
                    'bg-blue-50 text-blue-500',
                    'bg-coral-soft/50 text-coral',
                    'bg-sky-soft text-blue-500',
                ];
            @endphp

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $i => $s)
                    <a href="{{ route('services') }}#{{ $s['anchor'] }}"
                       @class([
                           'reveal group flex flex-col rounded-3xl border border-blue-100/70 bg-paper p-7 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl',
                           'lg:col-span-1' => true,
                           'sm:col-span-2 lg:col-span-1' => $i === 6,
                       ])>
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl {{ $iconTints[$i] ?? 'bg-blue-50 text-blue-500' }} transition group-hover:bg-blue-500 group-hover:text-cream">
                            <x-ui.icon :name="$s['icon']" class="h-6 w-6" />
                        </span>
                        <h3 class="mt-5 font-display text-xl font-semibold text-ink">{{ $s['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink/65">{{ $s['text'] }}</p>
                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-500">
                            {{ __('Saber mais') }}
                            <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-0.5" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Principles (bold blue band) ─────────────────────────── --}}
    <section class="relative overflow-hidden bg-blue-500 py-20 text-cream sm:py-28">
        {{-- geometric punctuation + a white bird --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-blue-400/40"></div>
            <div class="absolute bottom-0 left-1/3 h-44 w-44 rounded-full bg-blue-700/50"></div>
            <x-brand.mark class="absolute -right-2 bottom-6 h-44 w-auto text-cream/10" />
        </div>

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-sun">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-sun"></span>{{ __('Princípios') }}
                </span>
                <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-cream sm:text-5xl">
                    {{ __('Cultivamos como quem cuida do solo') }}
                </h2>
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

            <div class="mt-14 grid gap-x-10 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($principles as $p)
                    <div class="reveal border-t border-cream/25 pt-5">
                        <span class="font-display text-2xl font-semibold text-sun">{{ $p['n'] }}</span>
                        <h3 class="mt-3 font-display text-xl font-semibold text-cream">{{ $p['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-cream/75">{{ $p['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Process ─────────────────────────── --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('Como trabalhamos') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">
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
                <div class="reveal group relative overflow-hidden rounded-3xl bg-sky-soft/60 p-7 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    {{-- a soft sun in the corner --}}
                    <div class="pointer-events-none absolute -right-6 -top-6 h-20 w-20 rounded-full bg-sun/50" aria-hidden="true"></div>
                    <span class="relative inline-flex h-12 w-12 items-center justify-center rounded-full bg-blue-500 text-cream">
                        <x-ui.icon :name="$step['icon']" class="h-6 w-6" />
                    </span>
                    <p class="relative mt-5 text-xs font-semibold uppercase tracking-[0.16em] text-blue-500">{{ sprintf('%02d', $i + 1) }}</p>
                    <h3 class="relative mt-1 font-display text-2xl font-semibold text-ink">{{ $step['step'] }}</h3>
                    <p class="relative mt-2 text-sm leading-relaxed text-ink/65">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ─────────────────────────── Who we serve ─────────────────────────── --}}
    <section class="bg-cream-deep py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div class="relative">
                    {{-- sun-circle motif with the bird --}}
                    <div class="relative mb-10 hidden h-28 w-28 lg:block">
                        <div class="absolute inset-0 rounded-full bg-sun"></div>
                        <x-brand.mark class="absolute left-1/2 top-1/2 h-16 w-auto -translate-x-1/2 -translate-y-1/2 text-blue-500" />
                    </div>
                    <x-ui.eyebrow>{{ __('Para quem') }}</x-ui.eyebrow>
                    <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">
                        {{ __('Quem semeia futuro') }}
                    </h2>
                    <p class="mt-5 max-w-md text-pretty leading-relaxed text-ink/70">
                        {{ __('Somos parceiros de comunicação de universidades, ONG, redes e projetos europeus — e de empresas que querem comunicar de outra forma. Se está a fazer algo bom no mundo, ajudamos a torná-lo mais alto.') }}
                    </p>
                    <div class="mt-8">
                        <x-ui.button :href="route('contact')">{{ __('Trabalhar connosco') }}</x-ui.button>
                    </div>
                </div>

                @php
                    $audiences = [
                        __('Projetos europeus (Horizonte, Erasmus+, Interreg, LIFE…)'),
                        __('Universidades e centros de investigação'),
                        __('ONG e redes de impacto'),
                        __('Educação, cultura e cidadania'),
                        __('Agricultura regenerativa e permacultura'),
                        __('Sustentabilidade e ambiente'),
                        __('Cooperativas e economia social'),
                        __('Empresas com propósito'),
                    ];
                @endphp
                <ul class="grid gap-3 sm:grid-cols-2">
                    @foreach ($audiences as $a)
                        <li class="reveal flex items-start gap-3 rounded-2xl bg-paper px-5 py-4 ring-1 ring-blue-100/70 transition hover:ring-blue-200">
                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500 text-cream">
                                <x-ui.icon name="check" class="h-3.5 w-3.5" />
                            </span>
                            <span class="text-sm font-medium text-ink/85">{{ $a }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── Journal (blog) ─────────────────────────── --}}
    <x-site.blog-feature />

    {{-- ─────────────────────────── CTA ─────────────────────────── --}}
    <div class="py-20 sm:py-24">
        <x-site.cta />
    </div>
</x-layouts.site>
