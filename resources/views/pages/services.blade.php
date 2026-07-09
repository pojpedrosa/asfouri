<x-layouts.site :title="__('Serviços')" :description="__('Comunicação regenerativa, redes sociais, plataformas web, componente offline, IA, branding e ilustração e gestão de marca.')">
    <x-site.page-hero
        :eyebrow="__('Serviços')"
        :title="__('Tudo o que o seu projeto precisa para comunicar com raiz')"
        :intro="__('Sete disciplinas que funcionam juntas ou em separado. Pode começar por uma e crescer connosco — ou confiar-nos a comunicação de ponta a ponta.')">
        <div class="mt-10 flex flex-wrap gap-2">
            @php
                $chips = [
                    'comunicacao' => __('Estratégia e narrativa'),
                    'redes' => __('Redes sociais'),
                    'plataformas' => __('Plataformas web'),
                    'offline' => __('Offline'),
                    'ia' => __('IA regenerativa'),
                    'branding' => __('Branding e ilustração'),
                    'marca' => __('Gestão de marca'),
                ];
            @endphp
            @foreach ($chips as $anchor => $label)
                <a href="#{{ $anchor }}" class="rounded-full border border-blue-200 bg-paper px-4 py-1.5 text-sm font-medium text-blue-700 transition hover:border-blue-500 hover:bg-blue-500 hover:text-cream">{{ $label }}</a>
            @endforeach
        </div>
    </x-site.page-hero>

    @php
        $services = [
            [
                'id' => 'comunicacao', 'icon' => 'comms', 'num' => '01', 'accent' => 'blue',
                'title' => __('Estratégia e narrativa'),
                'lead' => __('Damos voz ao impacto real do seu projeto — sem greenwashing, sem ruído.'),
                'body' => __('Construímos a história da sua organização a partir do que ela realmente faz pelo mundo. Definimos mensagens, tom e arquitetura de conteúdos que aproximam as pessoas certas e regeneram confiança a cada contacto.'),
                'items' => [
                    __('Estratégia de comunicação e posicionamento'),
                    __('Narrativa de marca e mensagens-chave'),
                    __('Planos editoriais e de conteúdo'),
                    __('Copywriting e storytelling'),
                    __('Comunicação de impacto e relatórios vivos'),
                    __('Assessoria e relação com media'),
                ],
            ],
            [
                'id' => 'redes', 'icon' => 'social', 'num' => '02', 'accent' => 'coral',
                'title' => __('Gestão de redes sociais'),
                'lead' => __('Presença digital cultivada com ritmo humano: comunidade em vez de vaidade.'),
                'body' => __('Gerimos as suas redes como quem cuida de um jardim partilhado — conteúdo consistente, conversa genuína e métricas que importam. Menos algoritmo a perseguir, mais relação a florescer.'),
                'items' => [
                    __('Estratégia e calendário de redes sociais'),
                    __('Criação de conteúdo (texto, foto, vídeo curto)'),
                    __('Gestão de comunidade e moderação cuidada'),
                    __('Design de templates e identidade social'),
                    __('Campanhas e divulgação responsável'),
                    __('Relatórios honestos e aprendizagem contínua'),
                ],
            ],
            [
                'id' => 'plataformas', 'icon' => 'web', 'num' => '03', 'accent' => 'gold',
                'title' => __('Aplicações e plataformas web'),
                'lead' => __('Sites, plataformas e ferramentas sob medida — rápidas, acessíveis e sustentáveis.'),
                'body' => __('Desenhamos e programamos produtos digitais que duram. Código limpo, desempenho cuidado e acessibilidade desde o primeiro dia, com tecnologia robusta que a sua equipa consegue gerir.'),
                'items' => [
                    __('Websites e páginas de campanha'),
                    __('Plataformas e aplicações web sob medida'),
                    __('Lojas e sistemas de subscrição'),
                    __('Áreas reservadas, mapas e diretórios'),
                    __('Integrações, APIs e automatização'),
                    __('Manutenção, alojamento e desempenho'),
                ],
            ],
            [
                'id' => 'offline', 'icon' => 'offline', 'num' => '04', 'accent' => 'sky',
                'title' => __('Componente offline'),
                'lead' => __('Editorial, impressão, sinalética, instalações e eventos — comunicação que se toca.'),
                'body' => __('Nem tudo vive no ecrã. Levamos a mesma coerência ao mundo físico: do livro à exposição, do mercado à conferência. Materiais pensados para durar e para reduzir o desperdício.'),
                'items' => [
                    __('Design editorial e publicações'),
                    __('Impressão responsável e materiais'),
                    __('Sinalética e comunicação de espaços'),
                    __('Instalações e exposições'),
                    __('Produção e comunicação de eventos'),
                    __('Merchandising com propósito'),
                ],
            ],
            [
                'id' => 'ia', 'icon' => 'ai', 'num' => '05', 'accent' => 'blue',
                'title' => __('IA como ferramenta regenerativa'),
                'lead' => __('Inteligência artificial ao serviço das pessoas — com critério, transparência e ética.'),
                'body' => __('Usamos as novas ferramentas de IA para libertar tempo, não para substituir o cuidado humano. Desenhamos fluxos que aceleram a investigação, a produção e a personalização, sempre com revisão humana e respeito por quem cria.'),
                'items' => [
                    __('Fluxos de trabalho assistidos por IA'),
                    __('Assistentes e chatbots com conhecimento próprio'),
                    __('Apoio à investigação, síntese e tradução'),
                    __('Geração e tratamento de conteúdo com revisão humana'),
                    __('Automatização de tarefas repetitivas'),
                    __('Formação e políticas de uso responsável'),
                ],
            ],
            [
                'id' => 'branding', 'icon' => 'branding', 'num' => '06', 'accent' => 'coral',
                'title' => __('Branding e ilustração'),
                'lead' => __('Identidades vivas e ilustração feita à mão que tornam a sua marca inconfundível.'),
                'body' => __('Criamos marcas com alma — sistemas visuais flexíveis, tipografia, cor e ilustração original que dão personalidade e calor. Identidades que crescem com o projeto, em vez de o engessar.'),
                'items' => [
                    __('Naming e plataforma de marca'),
                    __('Logótipo e sistema de identidade visual'),
                    __('Ilustração e iconografia originais'),
                    __('Direção de arte e fotografia'),
                    __('Manual de marca e ativos'),
                    __('Papelaria e aplicações'),
                ],
            ],
            [
                'id' => 'marca', 'icon' => 'brand', 'num' => '07', 'accent' => 'gold',
                'title' => __('Gestão de marca'),
                'lead' => __('Acompanhamento contínuo para a marca crescer coerente ao longo das estações.'),
                'body' => __('A marca não termina no manual. Acompanhamos a sua evolução no tempo, garantindo consistência entre canais e equipas, e ajustando o rumo à medida que o projeto e o contexto mudam.'),
                'items' => [
                    __('Guardião de marca e consistência'),
                    __('Governança e bibliotecas de ativos'),
                    __('Apoio e formação a equipas internas'),
                    __('Arquitetura de marca e submarcas'),
                    __('Evolução e revisões de marca'),
                    __('Acompanhamento como parceiro contínuo'),
                ],
            ],
        ];
    @endphp

    @php
        // Brand accent palette per discipline. tile = icon chip; lead = lead text;
        // num = big index number; sun = decorative sun-circle; dot/bullet = check chips.
        $accents = [
            'blue' => [
                'tile' => 'bg-blue-500 text-cream',
                'lead' => 'text-blue-700',
                'num'  => 'text-blue-400',
                'sun'  => 'bg-blue-100',
                'bullet' => 'bg-blue-100 text-blue-600',
                'rule' => 'group-hover/svc:text-blue-500',
            ],
            'coral' => [
                'tile' => 'bg-coral text-ink',
                'lead' => 'text-gold',
                'num'  => 'text-blue-400',
                'sun'  => 'bg-coral-soft/50',
                'bullet' => 'bg-coral-soft/40 text-gold',
                'rule' => 'group-hover/svc:text-coral',
            ],
            'gold' => [
                'tile' => 'bg-gold text-ink',
                'lead' => 'text-blue-700',
                'num'  => 'text-blue-400',
                'sun'  => 'bg-sun/60',
                'bullet' => 'bg-sun/50 text-blue-700',
                'rule' => 'group-hover/svc:text-gold',
            ],
            'sky' => [
                'tile' => 'bg-sky text-blue-800',
                'lead' => 'text-blue-700',
                'num'  => 'text-blue-400',
                'sun'  => 'bg-sky-soft',
                'bullet' => 'bg-sky-soft text-blue-600',
                'rule' => 'group-hover/svc:text-blue-500',
            ],
        ];
    @endphp

    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        @foreach ($services as $i => $s)
            @php $a = $accents[$s['accent']]; @endphp
            <section id="{{ $s['id'] }}" class="group/svc scroll-mt-24 border-b border-cream-deep py-16 sm:py-20 last:border-b-0">
                <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:gap-16">
                    <div class="reveal">
                        <div class="flex items-center gap-4">
                            <span class="relative inline-flex h-14 w-14 items-center justify-center rounded-2xl {{ $a['tile'] }}">
                                {{-- sun-circle peeking behind the icon chip --}}
                                <span class="absolute -right-2 -top-2 -z-10 h-7 w-7 rounded-full {{ $a['sun'] }}" aria-hidden="true"></span>
                                <x-ui.icon :name="$s['icon']" class="h-7 w-7" />
                            </span>
                            <span class="font-display text-3xl font-semibold {{ $a['num'] }}">{{ $s['num'] }}</span>
                        </div>
                        <h2 class="mt-6 font-display text-3xl font-semibold text-balance text-blue-500 sm:text-4xl">{{ $s['title'] }}</h2>
                        <p class="mt-4 text-lg font-semibold {{ $a['lead'] }}">{{ $s['lead'] }}</p>
                        <p class="mt-4 max-w-md text-pretty leading-relaxed text-ink/70">{{ $s['body'] }}</p>
                    </div>
                    <div class="reveal lg:pt-2">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-blue-400">{{ __('O que inclui') }}</p>
                        <ul class="mt-5 grid gap-x-8 gap-y-3 sm:grid-cols-2">
                            @foreach ($s['items'] as $item)
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full {{ $a['bullet'] }}">
                                        <x-ui.icon name="check" class="h-3.5 w-3.5" />
                                    </span>
                                    <span class="text-sm leading-relaxed text-ink/80">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    <div class="py-20 sm:py-24">
        <x-site.cta
            :eyebrow="__('Pronto para começar?')"
            :heading="__('Diga-nos o que quer fazer crescer')"
            :text="__('Quer um serviço pontual ou um parceiro de comunicação a longo prazo, começamos sempre por escutar.')" />
    </div>
</x-layouts.site>
