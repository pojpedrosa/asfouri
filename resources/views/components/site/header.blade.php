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
               data-[scrolled]:border-soil-200/70 data-[scrolled]:bg-parchment/85 data-[scrolled]:backdrop-blur-md">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-4 sm:px-8"
         aria-label="{{ __('Navegação principal') }}">
        <a href="{{ route('home') }}" class="shrink-0 text-soil-900" aria-label="asfouri — {{ __('Início') }}">
            <x-brand.wordmark />
        </a>

        {{-- Desktop nav --}}
        <div class="hidden items-center gap-1 lg:flex">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   @class([
                       'rounded-full px-4 py-2 text-sm font-medium transition-colors',
                       'text-clay-600' => request()->routeIs($item['route']),
                       'text-soil-700 hover:text-clay-600' => ! request()->routeIs($item['route']),
                   ])>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-3">
            {{-- Locale switch --}}
            <div class="hidden items-center text-xs font-semibold tracking-wide text-soil-500 sm:flex">
                <a href="{{ route('locale.switch', 'pt') }}"
                   @class(['px-1.5 transition-colors', 'text-soil-900' => $locale === 'pt', 'hover:text-soil-800' => $locale !== 'pt'])
                   aria-label="Português" @if($locale==='pt') aria-current="true" @endif>PT</a>
                <span class="text-soil-300">/</span>
                <a href="{{ route('locale.switch', 'en') }}"
                   @class(['px-1.5 transition-colors', 'text-soil-900' => $locale === 'en', 'hover:text-soil-800' => $locale !== 'en'])
                   aria-label="English" @if($locale==='en') aria-current="true" @endif>EN</a>
            </div>

            <x-ui.button :href="route('contact')" size="md" class="hidden sm:inline-flex">
                {{ __('Vamos conversar') }}
            </x-ui.button>

            {{-- Mobile toggle --}}
            <button data-nav-toggle type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-soil-200 text-soil-800 lg:hidden"
                    aria-expanded="false" aria-label="{{ __('Abrir menu') }}">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile panel --}}
    <div data-nav-panel data-open="false"
         class="fixed inset-0 z-50 hidden bg-soil-950/40 backdrop-blur-sm data-[open=true]:block lg:hidden">
        <div class="ml-auto flex h-full w-[82%] max-w-sm flex-col bg-parchment px-6 py-6 shadow-2xl">
            <div class="flex items-center justify-between">
                <x-brand.wordmark class="text-soil-900" />
                <button data-nav-toggle type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-soil-200 text-soil-800"
                        aria-label="{{ __('Fechar') }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            <div class="mt-10 flex flex-col gap-1">
                <a href="{{ route('home') }}" class="border-b border-soil-100 py-3 font-display text-2xl text-soil-900">{{ __('Início') }}</a>
                @foreach ($nav as $item)
                    <a href="{{ route($item['route']) }}" class="border-b border-soil-100 py-3 font-display text-2xl text-soil-900">{{ $item['label'] }}</a>
                @endforeach
                <a href="{{ route('contact') }}" class="py-3 font-display text-2xl text-clay-600">{{ __('Contacto') }}</a>
            </div>

            <div class="mt-auto flex items-center gap-2 text-sm font-semibold text-soil-500">
                <a href="{{ route('locale.switch', 'pt') }}" @class(['px-1', 'text-soil-900' => $locale === 'pt'])>Português</a>
                <span class="text-soil-300">·</span>
                <a href="{{ route('locale.switch', 'en') }}" @class(['px-1', 'text-soil-900' => $locale === 'en'])>English</a>
            </div>
        </div>
    </div>
</header>
