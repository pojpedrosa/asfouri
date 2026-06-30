@php
    $nav = [
        ['route' => 'approach', 'label' => __('Abordagem')],
        ['route' => 'services', 'label' => __('Serviços')],
        ['route' => 'work',     'label' => __('Projetos')],
        ['route' => 'about',    'label' => __('Sobre')],
    ];
    $locale = app()->getLocale();
@endphp

<header data-site-header
        class="sticky top-0 z-40 border-b border-transparent transition-colors duration-300
               data-[scrolled]:border-cream-deep data-[scrolled]:bg-cream/90 data-[scrolled]:backdrop-blur-md">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-4 sm:px-8"
         aria-label="{{ __('Navegação principal') }}">
        <a href="{{ route('home') }}" class="shrink-0 text-blue-500" aria-label="asfouri — {{ __('Início') }}">
            <x-brand.wordmark />
        </a>

        {{-- Desktop nav --}}
        <div class="hidden items-center gap-1 lg:flex">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   @class([
                       'rounded-full px-4 py-2 text-sm font-medium transition-colors',
                       'bg-blue-50 text-blue-700' => request()->routeIs($item['route']),
                       'text-ink/70 hover:bg-blue-50 hover:text-blue-700' => ! request()->routeIs($item['route']),
                   ])
                   @if(request()->routeIs($item['route'])) aria-current="page" @endif>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-3">
            {{-- Locale switch --}}
            <div class="hidden items-center text-xs font-semibold tracking-wide text-blue-500/50 sm:flex">
                <a href="{{ route('locale.switch', 'pt') }}"
                   @class(['px-1.5 transition-colors', 'text-blue-500' => $locale === 'pt', 'hover:text-blue-500' => $locale !== 'pt'])
                   aria-label="Português" @if($locale==='pt') aria-current="true" @endif>PT</a>
                <span class="text-blue-500/30">/</span>
                <a href="{{ route('locale.switch', 'en') }}"
                   @class(['px-1.5 transition-colors', 'text-blue-500' => $locale === 'en', 'hover:text-blue-500' => $locale !== 'en'])
                   aria-label="English" @if($locale==='en') aria-current="true" @endif>EN</a>
            </div>

            <x-ui.button :href="route('contact')" size="md" class="hidden sm:inline-flex">
                {{ __('Vamos conversar') }}
            </x-ui.button>

            {{-- Mobile toggle --}}
            <button data-nav-toggle type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-blue-500/30 text-blue-500 transition-colors hover:bg-blue-50 lg:hidden"
                    aria-expanded="false" aria-label="{{ __('Abrir menu') }}">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile panel --}}
    <div data-nav-panel data-open="false"
         class="fixed inset-0 z-50 hidden bg-blue-900/40 backdrop-blur-sm data-[open=true]:block lg:hidden">
        <div class="ml-auto flex h-full w-[82%] max-w-sm flex-col bg-cream px-6 py-6 shadow-2xl">
            <div class="flex items-center justify-between">
                <x-brand.wordmark class="text-blue-500" />
                <button data-nav-toggle type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-blue-500/30 text-blue-500 transition-colors hover:bg-blue-50"
                        aria-label="{{ __('Fechar') }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            <div class="mt-10 flex flex-col gap-1">
                <a href="{{ route('home') }}" class="border-b border-cream-deep py-3 font-display text-2xl font-medium tracking-tight text-ink">{{ __('Início') }}</a>
                @foreach ($nav as $item)
                    <a href="{{ route($item['route']) }}" class="border-b border-cream-deep py-3 font-display text-2xl font-medium tracking-tight text-ink">{{ $item['label'] }}</a>
                @endforeach
                <a href="{{ route('contact') }}" class="py-3 font-display text-2xl font-semibold tracking-tight text-blue-500">{{ __('Contacto') }}</a>
            </div>

            <div class="mt-auto flex items-center gap-2 text-sm font-semibold text-ink/50">
                <a href="{{ route('locale.switch', 'pt') }}" @class(['px-1', 'text-blue-500' => $locale === 'pt'])>Português</a>
                <span class="text-ink/25">·</span>
                <a href="{{ route('locale.switch', 'en') }}" @class(['px-1', 'text-blue-500' => $locale === 'en'])>English</a>
            </div>
        </div>
    </div>
</header>
