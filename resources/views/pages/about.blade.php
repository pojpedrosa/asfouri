<x-layouts.site :title="__('Sobre')" :description="__('A asfouri é uma agência de comunicação regenerativa. Conheça a história, o significado do nome e os valores que nos guiam.')">
    <x-site.page-hero
        :eyebrow="__('Sobre')"
        :title="__('Uma agência enraizada no cuidado')"
        :intro="__('A asfouri nasce do encontro entre comunicação, design, tecnologia e ecologia — e da convicção de que estas ferramentas podem regenerar, em vez de esgotar.')" />

    {{-- Name story — lean into the sparrow --}}
    <section class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:gap-16">
            <div>
                <x-ui.eyebrow>{{ __('O nome') }}</x-ui.eyebrow>
                <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">
                    <span class="font-wordmark lowercase">{{ __('asfouri') }}</span>
                    <span class="text-sky"> · </span>
                    <span class="text-gold">{{ __('o meu pequeno pássaro') }}</span>
                </h2>
                <p class="mt-6 text-pretty text-lg leading-relaxed text-ink/80">
                    {{ __('Em árabe, “asfour” (عصفور) é pássaro; “asfouri” (عصفوري) é a forma afetuosa — o meu passarinho. Um pássaro vive entre dois mundos: enraíza-se na terra para se alimentar e nidificar, e levanta voo para cantar, semear e ligar lugares distantes.') }}
                </p>
                <p class="mt-4 text-pretty leading-relaxed text-ink/70">
                    {{ __('É exatamente isto que procuramos na comunicação: raízes firmes no real e no local, e a leveza de uma voz que viaja, espalha sementes e regenera por onde passa.') }}
                </p>
            </div>

            {{-- Brand composition: sun-circle + sparrow + geometric shapes --}}
            <div class="relative">
                <div class="relative mx-auto grid aspect-square w-full max-w-sm place-items-center overflow-hidden rounded-[2.5rem] bg-blue-500">
                    {{-- big rising sun --}}
                    <span class="absolute left-1/2 top-1/2 h-56 w-56 -translate-x-1/2 -translate-y-1/2 rounded-full bg-sun" aria-hidden="true"></span>
                    {{-- scattered geometric accents --}}
                    <span class="absolute left-8 top-10 h-12 w-12 rounded-full bg-coral" aria-hidden="true"></span>
                    <span class="absolute bottom-12 right-10 h-8 w-8 rounded-full bg-sky" aria-hidden="true"></span>
                    <span class="absolute bottom-9 left-12 h-3 w-3 rounded-full bg-cream" aria-hidden="true"></span>
                    <span class="absolute right-12 top-12 h-3 w-3 rounded-full bg-cream" aria-hidden="true"></span>
                    {{-- the sparrow, on the sun --}}
                    <x-brand.mark class="animate-drift relative h-32 w-auto text-blue-700" />
                </div>
                {{-- floating caption chip --}}
                <div class="absolute -bottom-5 -left-4 hidden rounded-2xl bg-paper px-5 py-4 shadow-lg ring-1 ring-cream-deep sm:block">
                    <p class="font-display text-lg font-semibold text-blue-500">{{ __('Raízes e voo,') }}</p>
                    <p class="-mt-1 font-display text-lg font-medium text-gold">{{ __('a mesma ave.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Belief / story --}}
    <section class="bg-cream-deep py-20 sm:py-28">
        <div class="mx-auto max-w-4xl px-5 sm:px-8">
            <x-ui.eyebrow>{{ __('Porque existimos') }}</x-ui.eyebrow>
            <div class="mt-7 space-y-6 text-pretty text-lg leading-relaxed text-ink/80">
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
            <h2 class="mt-5 font-display text-4xl font-semibold tracking-tight text-balance text-blue-500 sm:text-5xl">{{ __('O que nos mantém em pé') }}</h2>
        </div>
        @php
            $values = [
                ['icon' => 'care',      'title' => __('Cuidado'),       'text' => __('Tratamos cada projeto, palavra e píxel com a atenção de quem cuida de algo vivo.')],
                ['icon' => 'root',      'title' => __('Honestidade'),   'text' => __('Dizemos o que é verdade, mesmo quando é mais difícil. Sem greenwashing.')],
                ['icon' => 'social',    'title' => __('Colaboração'),   'text' => __('Trabalhamos com — e não para. As melhores soluções crescem em conjunto.')],
                ['icon' => 'cultivate', 'title' => __('Artesania'),     'text' => __('Gostamos do trabalho bem feito, do detalhe e do tempo que a qualidade pede.')],
                ['icon' => 'ai',        'title' => __('Curiosidade'),   'text' => __('Experimentamos novas ferramentas e linguagens, com critério e sentido crítico.')],
                ['icon' => 'flourish',  'title' => __('Regeneração'),   'text' => __('Existimos para deixar pessoas, projetos e lugares mais férteis do que os encontrámos.')],
            ];
        @endphp
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($values as $v)
                <div class="reveal group rounded-3xl border border-cream-deep bg-paper p-7 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-soft text-blue-500 transition group-hover:bg-sun group-hover:text-blue-700">
                        <x-ui.icon :name="$v['icon']" class="h-6 w-6" />
                    </span>
                    <h3 class="mt-5 font-display text-xl font-semibold text-blue-500">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink/70">{{ $v['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Team --}}
    <x-site.team />

    {{-- How we work — bold blue band (the engine) --}}
    <section class="relative overflow-hidden bg-blue-500 py-20 text-cream sm:py-24">
        {{-- decorative sun + white sparrow --}}
        <span class="pointer-events-none absolute -left-16 -top-16 h-64 w-64 rounded-full bg-blue-400/30" aria-hidden="true"></span>
        <x-brand.mark class="animate-drift pointer-events-none absolute -right-4 bottom-2 h-40 w-auto text-cream/10 sm:h-56" />

        <div class="relative mx-auto max-w-5xl px-5 text-center sm:px-8">
            <x-brand.mark class="mx-auto h-12 w-auto text-sun" />
            <h2 class="mt-6 font-display text-3xl font-semibold tracking-tight text-balance text-paper sm:text-4xl">{{ __('Pequenos por opção, profundos por método') }}</h2>
            <p class="mx-auto mt-5 max-w-2xl text-pretty leading-relaxed text-cream/85">
                {{ __('Somos uma equipa-núcleo enxuta com uma rede de criativos, programadores e artistas que reunimos à medida de cada projeto. Sem estrutura pesada, sem intermediários — só as pessoas certas, próximas de si, do início ao fim.') }}
            </p>
            <div class="mt-9 flex flex-wrap justify-center gap-3">
                <x-ui.button :href="route('services')" variant="light">{{ __('Ver serviços') }}</x-ui.button>
                <x-ui.button :href="route('contact')" variant="ghost" class="text-cream hover:text-sun">{{ __('Falar connosco') }} →</x-ui.button>
            </div>
        </div>
    </section>
</x-layouts.site>
