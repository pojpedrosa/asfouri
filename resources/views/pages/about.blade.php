<x-layouts.site :title="__('Sobre')" :description="__('A asfouri é uma agência de comunicação regenerativa. Conheça a história, o significado do nome e os valores que nos guiam.')">
    <x-site.page-hero
        :eyebrow="__('Sobre')"
        :title="__('Uma agência enraizada no cuidado')"
        :intro="__('A asfouri nasce do encontro entre comunicação, design, tecnologia e ecologia — e da convicção de que estas ferramentas podem regenerar, em vez de esgotar.')" />

    {{-- Name story --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:gap-16">
            <div>
                <x-ui.eyebrow>{{ __('O nome') }}</x-ui.eyebrow>
                <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">
                    {{ __('asfouri') }} <span class="text-soil-300">·</span> <span class="italic text-clay-600">{{ __('o meu pequeno pássaro') }}</span>
                </h2>
                <p class="mt-6 text-pretty text-lg leading-relaxed text-soil-700">
                    {{ __('Em árabe, “asfour” (عصفور) é pássaro; “asfouri” (عصفوري) é a forma afetuosa — o meu passarinho. Um pássaro vive entre dois mundos: enraíza-se na terra para se alimentar e nidificar, e levanta voo para cantar, semear e ligar lugares distantes.') }}
                </p>
                <p class="mt-4 text-pretty leading-relaxed text-soil-600">
                    {{ __('É exatamente isto que procuramos na comunicação: raízes firmes no real e no local, e a leveza de uma voz que viaja, espalha sementes e regenera por onde passa.') }}
                </p>
            </div>
            <div class="relative">
                <div class="blob grain mx-auto aspect-square w-full max-w-sm overflow-hidden bg-gradient-to-br from-dawn-200 via-wheat-100 to-moss-200">
                    <svg class="absolute inset-0 h-full w-full" viewBox="0 0 400 400" preserveAspectRatio="xMidYMid slice" fill="none" aria-hidden="true">
                        <circle cx="300" cy="110" r="60" fill="#e6b454" opacity="0.65"/>
                        <path d="M0 300 C100 285 180 312 260 298 C330 286 370 306 400 296 L400 400 L0 400 Z" fill="#8f6c45"/>
                        <path d="M0 340 C110 326 190 350 270 338 C340 328 380 346 400 338 L400 400 L0 400 Z" fill="#573c24"/>
                        <path d="M200 300 C200 250 198 215 200 178" stroke="#42512c" stroke-width="6" stroke-linecap="round"/>
                        <path d="M200 232 C170 226 145 204 132 174 C168 176 192 198 200 232 Z" fill="#6c8341"/>
                        <path d="M200 210 C230 202 256 180 268 150 C232 152 208 174 200 210 Z" fill="#859d54"/>
                        <g class="animate-drift" transform="translate(150 90)">
                            <path d="M0 18 C6 8 18 4 30 8 C36 10 40 14 42 20 L52 14 C52 20 48 24 42 26 C44 34 38 42 28 44 C14 46 2 38 0 24 Z" fill="#432d1b"/>
                            <circle cx="34" cy="17" r="2" fill="#f5efe1"/>
                            <path d="M52 14 L62 11 L54 19 Z" fill="#c05a36"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- Belief / story --}}
    <section class="bg-parchment-deep py-20 sm:py-28">
        <div class="mx-auto max-w-4xl px-5 sm:px-8">
            <x-ui.eyebrow>{{ __('Porque existimos') }}</x-ui.eyebrow>
            <div class="mt-7 space-y-6 text-pretty text-lg leading-relaxed text-soil-700">
                <p>{{ __('Vimos demasiados projetos extraordinários — quintas regenerativas, cooperativas, movimentos, organizações de impacto — a fazer um trabalho que muda o mundo e a ficarem invisíveis por falta de meios para o comunicar.') }}</p>
                <p>{{ __('Ao mesmo tempo, vimos uma indústria da comunicação a funcionar como uma máquina extrativa: a esgotar a atenção, a inflacionar promessas e a deixar pessoas e equipas exaustas.') }}</p>
                <p>{{ __('A asfouri existe para juntar as duas pontas — e para tornar o bem mais alto. Somos parceiros de comunicação de universidades, ONG, redes e projetos europeus, pondo a melhor estratégia, design e tecnologia ao serviço de quem regenera, sempre segundo os princípios que defendemos.') }}</p>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="max-w-2xl">
            <x-ui.eyebrow>{{ __('Valores') }}</x-ui.eyebrow>
            <h2 class="mt-5 font-display text-4xl font-medium text-balance text-soil-900 sm:text-5xl">{{ __('O que nos mantém em pé') }}</h2>
        </div>
        @php
            $values = [
                ['icon' => 'leaf',      'title' => __('Cuidado'),       'text' => __('Tratamos cada projeto, palavra e píxel com a atenção de quem cuida de algo vivo.')],
                ['icon' => 'root',      'title' => __('Honestidade'),   'text' => __('Dizemos o que é verdade, mesmo quando é mais difícil. Sem greenwashing.')],
                ['icon' => 'social',    'title' => __('Colaboração'),   'text' => __('Trabalhamos com — e não para. As melhores soluções crescem em conjunto.')],
                ['icon' => 'cultivate', 'title' => __('Artesania'),     'text' => __('Gostamos do trabalho bem feito, do detalhe e do tempo que a qualidade pede.')],
                ['icon' => 'ai',        'title' => __('Curiosidade'),   'text' => __('Experimentamos novas ferramentas e linguagens, com critério e sentido crítico.')],
                ['icon' => 'flourish',  'title' => __('Regeneração'),   'text' => __('Existimos para deixar pessoas, projetos e lugares mais férteis do que os encontrámos.')],
            ];
        @endphp
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($values as $v)
                <div class="reveal rounded-2xl border border-soil-100 bg-parchment p-7">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-clay-100 text-clay-600">
                        <x-ui.icon :name="$v['icon']" class="h-6 w-6" />
                    </span>
                    <h3 class="mt-5 font-display text-xl text-soil-900">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-soil-600">{{ $v['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- How we work, lightweight --}}
    <section class="bg-soil-900 py-20 text-soil-100 sm:py-24">
        <div class="grain mx-auto max-w-5xl px-5 text-center sm:px-8">
            <h2 class="font-display text-3xl font-medium text-balance text-parchment sm:text-4xl">{{ __('Pequenos por opção, profundos por método') }}</h2>
            <p class="mx-auto mt-5 max-w-2xl text-pretty leading-relaxed text-soil-200">
                {{ __('Somos uma equipa-núcleo enxuta com uma rede de criativos, programadores e artistas que reunimos à medida de cada projeto. Sem estrutura pesada, sem intermediários — só as pessoas certas, próximas de si, do início ao fim.') }}
            </p>
            <div class="mt-9 flex flex-wrap justify-center gap-3">
                <x-ui.button :href="route('services')" variant="light">{{ __('Ver serviços') }}</x-ui.button>
                <x-ui.button :href="route('contact')" variant="ghost" class="text-parchment hover:text-wheat-300">{{ __('Falar connosco') }} →</x-ui.button>
            </div>
        </div>
    </section>
</x-layouts.site>
