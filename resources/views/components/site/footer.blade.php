@php
    $year = now()->year;
@endphp

<footer class="relative mt-24 bg-soil-900 text-soil-100">
    {{-- soil horizon edge --}}
    <div class="absolute -top-px left-0 right-0 h-6 overflow-hidden" aria-hidden="true">
        <svg class="h-6 w-full text-soil-900" viewBox="0 0 1440 24" preserveAspectRatio="none" fill="currentColor">
            <path d="M0 24 V10 C160 2 320 18 480 12 C640 6 800 16 960 10 C1120 4 1280 16 1440 10 V24 Z"/>
        </svg>
    </div>

    <div class="grain mx-auto max-w-7xl px-5 pb-10 pt-20 sm:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
            <div class="max-w-sm">
                <span class="inline-flex items-center gap-2.5 text-parchment">
                    <x-brand.mark class="h-9 w-auto text-moss-300" />
                    <span class="font-display text-2xl font-medium lowercase tracking-tight">asfouri</span>
                </span>
                <p class="mt-4 text-pretty text-sm leading-relaxed text-soil-200">
                    {{ __('Uma agência de comunicação regenerativa. Histórias, marcas e plataformas para quem trabalha a regenerar a terra, as comunidades e a cultura.') }}
                </p>
                <a href="mailto:hello@asfouri.media"
                   class="mt-6 inline-block font-display text-xl text-wheat-300 underline decoration-wheat-500/40 underline-offset-4 hover:decoration-wheat-300">
                    hello@asfouri.media
                </a>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.18em] text-wheat-300">{{ __('Serviços') }}</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-soil-200">
                    <li><a href="{{ route('services') }}#comunicacao" class="hover:text-parchment">{{ __('Comunicação regenerativa') }}</a></li>
                    <li><a href="{{ route('services') }}#redes" class="hover:text-parchment">{{ __('Gestão de redes sociais') }}</a></li>
                    <li><a href="{{ route('services') }}#plataformas" class="hover:text-parchment">{{ __('Aplicações e plataformas web') }}</a></li>
                    <li><a href="{{ route('services') }}#offline" class="hover:text-parchment">{{ __('Componente offline') }}</a></li>
                    <li><a href="{{ route('services') }}#ia" class="hover:text-parchment">{{ __('IA como ferramenta regenerativa') }}</a></li>
                    <li><a href="{{ route('services') }}#branding" class="hover:text-parchment">{{ __('Branding e ilustração') }}</a></li>
                    <li><a href="{{ route('services') }}#marca" class="hover:text-parchment">{{ __('Gestão de marca') }}</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.18em] text-wheat-300">{{ __('Agência') }}</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-soil-200">
                    <li><a href="{{ route('approach') }}" class="hover:text-parchment">{{ __('Abordagem') }}</a></li>
                    <li><a href="{{ route('work') }}" class="hover:text-parchment">{{ __('Projetos') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-parchment">{{ __('Sobre') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-parchment">{{ __('Contacto') }}</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.18em] text-wheat-300">{{ __('Seguir') }}</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-soil-200">
                    <li><a href="https://instagram.com/asfouri.media" class="hover:text-parchment" rel="noopener">Instagram</a></li>
                    <li><a href="https://www.linkedin.com/company/asfouri" class="hover:text-parchment" rel="noopener">LinkedIn</a></li>
                    <li><a href="https://bsky.app/profile/asfouri.media" class="hover:text-parchment" rel="noopener">Bluesky</a></li>
                </ul>
                <div class="mt-6 flex items-center gap-2 text-xs font-semibold text-soil-300">
                    <a href="{{ route('locale.switch', 'pt') }}" @class(['hover:text-parchment', 'text-parchment' => app()->getLocale()==='pt'])>PT</a>
                    <span>·</span>
                    <a href="{{ route('locale.switch', 'en') }}" @class(['hover:text-parchment', 'text-parchment' => app()->getLocale()==='en'])>EN</a>
                </div>
            </div>
        </div>

        <div class="mt-16 flex flex-col gap-3 border-t border-soil-700/60 pt-6 text-xs text-soil-300 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ $year }} asfouri — {{ __('comunicação regenerativa') }}. {{ __('Feito com cuidado, em Portugal.') }}</p>
            <p class="text-soil-400">{{ __('عصفوري · pequeno pássaro · enraizar e levantar voo') }}</p>
        </div>
    </div>
</footer>
