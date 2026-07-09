@php
    $year = now()->year;
@endphp

<footer class="relative mt-24 overflow-hidden bg-blue-700 text-cream">
    {{-- large faint sparrow, a brand motif drifting in the corner --}}
    <x-brand.mark class="pointer-events-none absolute -bottom-8 right-4 h-64 w-auto text-cream/[0.06] sm:right-16 sm:h-80" />

    <div class="relative mx-auto max-w-7xl px-5 pb-10 pt-20 sm:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
            <div class="max-w-sm">
                <span class="inline-flex items-center gap-2.5 text-cream">
                    <x-brand.mark class="h-9 w-auto text-cream" />
                    <span class="font-wordmark text-[1.7rem] leading-none lowercase">asfouri</span>
                </span>
                <p class="mt-4 text-pretty text-sm leading-relaxed text-cream/75">
                    {{ __('Uma agência de comunicação regenerativa. Histórias, marcas e plataformas para quem trabalha a regenerar a terra, as comunidades e a cultura.') }}
                </p>
                <a href="mailto:hello@asfouri.media"
                   class="mt-6 inline-block font-display text-xl font-medium text-sun underline decoration-sun/40 underline-offset-4 transition hover:decoration-sun">
                    hello@asfouri.media
                </a>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.18em] text-sun">{{ __('Serviços') }}</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-cream/75">
                    <li><a href="{{ route('services') }}#comunicacao" class="transition hover:text-cream">{{ __('Estratégia e narrativa') }}</a></li>
                    <li><a href="{{ route('services') }}#redes" class="transition hover:text-cream">{{ __('Gestão de redes sociais') }}</a></li>
                    <li><a href="{{ route('services') }}#plataformas" class="transition hover:text-cream">{{ __('Aplicações e plataformas web') }}</a></li>
                    <li><a href="{{ route('services') }}#offline" class="transition hover:text-cream">{{ __('Componente offline') }}</a></li>
                    <li><a href="{{ route('services') }}#ia" class="transition hover:text-cream">{{ __('IA como ferramenta regenerativa') }}</a></li>
                    <li><a href="{{ route('services') }}#branding" class="transition hover:text-cream">{{ __('Branding e ilustração') }}</a></li>
                    <li><a href="{{ route('services') }}#marca" class="transition hover:text-cream">{{ __('Gestão de marca') }}</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.18em] text-sun">{{ __('Agência') }}</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-cream/75">
                    <li><a href="{{ route('approach') }}" class="transition hover:text-cream">{{ __('Abordagem') }}</a></li>
                    <li><a href="{{ route('work') }}" class="transition hover:text-cream">{{ __('Projetos') }}</a></li>
                    <li><a href="{{ route('about') }}" class="transition hover:text-cream">{{ __('Sobre') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="transition hover:text-cream">{{ __('Contacto') }}</a></li>
                    @if (Route::has('privacy'))
                        <li><a href="{{ route('privacy') }}" class="transition hover:text-cream">{{ __('Política de Privacidade') }}</a></li>
                    @endif
                    @if (Route::has('terms'))
                        <li><a href="{{ route('terms') }}" class="transition hover:text-cream">{{ __('Termos e Condições') }}</a></li>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.18em] text-sun">{{ __('Seguir') }}</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-cream/75">
                    <li><a href="https://instagram.com/asfouri.media" class="transition hover:text-cream" rel="noopener">Instagram</a></li>
                    <li><a href="https://www.linkedin.com/company/asfouri" class="transition hover:text-cream" rel="noopener">LinkedIn</a></li>
                    <li><a href="https://bsky.app/profile/asfouri.media" class="transition hover:text-cream" rel="noopener">Bluesky</a></li>
                </ul>
                <div class="mt-6 flex items-center gap-2 text-xs font-semibold text-cream/60">
                    <a href="{{ route('locale.switch', 'pt') }}" @class(['transition hover:text-cream', 'text-cream' => app()->getLocale()==='pt'])>PT</a>
                    <span>·</span>
                    <a href="{{ route('locale.switch', 'en') }}" @class(['transition hover:text-cream', 'text-cream' => app()->getLocale()==='en'])>EN</a>
                </div>
            </div>
        </div>

        <div class="mt-16 flex flex-col gap-3 border-t border-cream/15 pt-6 text-xs text-cream/60 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ $year }} asfouri — {{ __('comunicação regenerativa') }}.</p>
            <p class="text-cream/45">{{ __('عصفوري · pequeno pássaro · enraizar e levantar voo') }}</p>
        </div>
    </div>
</footer>
