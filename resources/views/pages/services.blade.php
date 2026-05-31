<x-layouts.site :title="__('Serviços')" :description="__('Comunicação regenerativa, redes sociais, plataformas web, componente offline, IA, branding e ilustração e gestão de marca.')">
    <x-site.page-hero
        :eyebrow="__('Serviços')"
        :title="__('Tudo o que o seu projeto precisa para comunicar com raiz')"
        :intro="__('Sete disciplinas que funcionam juntas ou em separado. Pode começar por uma e crescer connosco — ou confiar-nos a comunicação de ponta a ponta.')">
        <div class="mt-10 flex flex-wrap gap-2">
            @php
                $chips = [
                    'comunicacao' => __('Comunicação regenerativa'),
                    'redes' => __('Redes sociais'),
                    'plataformas' => __('Plataformas web'),
                    'offline' => __('Offline'),
                    'ia' => __('IA regenerativa'),
                    'branding' => __('Branding e ilustração'),
                    'marca' => __('Gestão de marca'),
                ];
            @endphp
            @foreach ($chips as $anchor => $label)
                <a href="#{{ $anchor }}" class="rounded-full border border-soil-200 px-4 py-1.5 text-sm font-medium text-soil-700 transition hover:border-clay-300 hover:bg-clay-50 hover:text-clay-700">{{ $label }}</a>
            @endforeach
        </div>
    </x-site.page-hero>

    @php
        $services = [
            [
                'id' => 'comunicacao', 'icon' => 'comms', 'num' => '01',
                'title' => __('Comunicação regenerativa'),
                'lead' => __('Estratégia e narrativa que dão voz ao impacto real do seu projeto — sem greenwashing, sem ruído.'),
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
                'id' => 'redes', 'icon' => 'social', 'num' => '02',
                'title' => __('Gestão de redes sociais regenerativa'),
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
                'id' => 'plataformas', 'icon' => 'web', 'num' => '03',
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
                'id' => 'offline', 'icon' => 'offline', 'num' => '04',
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
                'id' => 'ia', 'icon' => 'ai', 'num' => '05',
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
                'id' => 'branding', 'icon' => 'branding', 'num' => '06',
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
                'id' => 'marca', 'icon' => 'brand', 'num' => '07',
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

    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        @foreach ($services as $i => $s)
            <section id="{{ $s['id'] }}" class="scroll-mt-24 border-b border-soil-100 py-16 sm:py-20 last:border-b-0">
                <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:gap-16">
                    <div class="reveal">
                        <div class="flex items-center gap-4">
                            <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-moss-100 text-moss-700">
                                <x-icon :name="$s['icon']" class="h-7 w-7" />
                            </span>
                            <span class="font-display text-2xl text-soil-300">{{ $s['num'] }}</span>
                        </div>
                        <h2 class="mt-6 font-display text-3xl font-medium text-balance text-soil-900 sm:text-4xl">{{ $s['title'] }}</h2>
                        <p class="mt-4 text-lg font-medium text-clay-700">{{ $s['lead'] }}</p>
                        <p class="mt-4 max-w-md text-pretty leading-relaxed text-soil-600">{{ $s['body'] }}</p>
                    </div>
                    <div class="reveal lg:pt-2">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-soil-400">{{ __('O que inclui') }}</p>
                        <ul class="mt-5 grid gap-x-8 gap-y-3 sm:grid-cols-2">
                            @foreach ($s['items'] as $item)
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-clay-100 text-clay-600">
                                        <x-icon name="check" class="h-3.5 w-3.5" />
                                    </span>
                                    <span class="text-sm leading-relaxed text-soil-700">{{ $item }}</span>
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
