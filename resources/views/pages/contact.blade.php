<x-layouts.site :title="__('Contacto')" :description="__('Fale com a asfouri. Conte-nos o seu projeto regenerativo e respondemos com atenção.')">
    <x-site.page-hero
        :eyebrow="__('Contacto')"
        :title="__('Vamos plantar algo juntos')"
        :intro="__('Conte-nos o que está a cultivar. Lemos cada mensagem com atenção e respondemos, sem pressa mas sem o deixar à espera.')" />

    <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 sm:py-24">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
            {{-- Form --}}
            <div class="order-2 lg:order-1">
                @if (session('contact_sent'))
                    <div class="rounded-2xl border border-moss-300 bg-moss-50 p-8 text-center" role="status">
                        <span class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-full bg-moss-600 text-parchment">
                            <x-icon name="check" class="h-7 w-7" />
                        </span>
                        <h2 class="mt-5 font-display text-2xl text-soil-900">{{ __('Mensagem semeada!') }}</h2>
                        <p class="mt-2 text-soil-600">{{ __('Obrigado pelo seu contacto. Respondemos dentro de poucos dias úteis.') }}</p>
                        <div class="mt-6">
                            <x-ui.button :href="route('home')" variant="outline">{{ __('Voltar ao início') }}</x-ui.button>
                        </div>
                    </div>
                @else
                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-clay-300 bg-clay-50 p-4 text-sm text-clay-800" role="alert">
                            {{ __('Há campos por rever. Verifique e tente novamente.') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6" novalidate>
                        @csrf

                        {{-- Honeypot --}}
                        <div class="hidden" aria-hidden="true">
                            <label>{{ __('Não preencher') }}<input type="text" name="website" tabindex="-1" autocomplete="off" /></label>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-soil-800">{{ __('Nome') }} <span class="text-clay-500">*</span></label>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                       class="mt-2 w-full rounded-xl border border-soil-200 bg-parchment px-4 py-3 text-soil-900 placeholder:text-soil-400 focus:border-clay-400 focus:outline-none focus:ring-2 focus:ring-clay-200"
                                       placeholder="{{ __('O seu nome') }}" />
                                @error('name') <p class="mt-1.5 text-sm text-clay-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-soil-800">{{ __('Email') }} <span class="text-clay-500">*</span></label>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                       class="mt-2 w-full rounded-xl border border-soil-200 bg-parchment px-4 py-3 text-soil-900 placeholder:text-soil-400 focus:border-clay-400 focus:outline-none focus:ring-2 focus:ring-clay-200"
                                       placeholder="nome@exemplo.pt" />
                                @error('email') <p class="mt-1.5 text-sm text-clay-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="organisation" class="block text-sm font-semibold text-soil-800">{{ __('Organização') }}</label>
                                <input id="organisation" name="organisation" type="text" value="{{ old('organisation') }}"
                                       class="mt-2 w-full rounded-xl border border-soil-200 bg-parchment px-4 py-3 text-soil-900 placeholder:text-soil-400 focus:border-clay-400 focus:outline-none focus:ring-2 focus:ring-clay-200"
                                       placeholder="{{ __('Projeto, marca ou coletivo') }}" />
                                @error('organisation') <p class="mt-1.5 text-sm text-clay-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-soil-800">{{ __('Assunto') }}</label>
                                <input id="subject" name="subject" type="text" value="{{ old('subject') }}"
                                       class="mt-2 w-full rounded-xl border border-soil-200 bg-parchment px-4 py-3 text-soil-900 placeholder:text-soil-400 focus:border-clay-400 focus:outline-none focus:ring-2 focus:ring-clay-200"
                                       placeholder="{{ __('Em que podemos ajudar?') }}" />
                                @error('subject') <p class="mt-1.5 text-sm text-clay-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-soil-800">{{ __('Mensagem') }} <span class="text-clay-500">*</span></label>
                            <textarea id="message" name="message" rows="6" required
                                      class="mt-2 w-full rounded-xl border border-soil-200 bg-parchment px-4 py-3 text-soil-900 placeholder:text-soil-400 focus:border-clay-400 focus:outline-none focus:ring-2 focus:ring-clay-200"
                                      placeholder="{{ __('Conte-nos sobre o seu projeto, os seus objetivos e o que procura.') }}">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1.5 text-sm text-clay-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-wrap items-center gap-4">
                            <x-ui.button size="lg">{{ __('Enviar mensagem') }}</x-ui.button>
                            <p class="text-xs text-soil-500">{{ __('Ao enviar, concorda em ser contactado a respeito do seu pedido.') }}</p>
                        </div>
                    </form>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="order-1 lg:order-2">
                <div class="grain rounded-2xl bg-soil-900 p-8 text-soil-100">
                    <x-brand.mark class="h-12 w-auto text-moss-300" />
                    <h2 class="mt-6 font-display text-2xl text-parchment">{{ __('Prefere falar diretamente?') }}</h2>
                    <p class="mt-3 text-sm leading-relaxed text-soil-200">{{ __('Escreva-nos por email ou siga-nos. Estamos sempre abertos a conhecer projetos que regeneram.') }}</p>

                    <dl class="mt-8 space-y-5 text-sm">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-wheat-300">{{ __('Email') }}</dt>
                            <dd class="mt-1"><a href="mailto:hello@asfouri.media" class="text-parchment underline decoration-wheat-500/40 underline-offset-4 hover:decoration-wheat-300">hello@asfouri.media</a></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-wheat-300">{{ __('Onde estamos') }}</dt>
                            <dd class="mt-1 text-soil-200">{{ __('Portugal · a trabalhar com o mundo') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-wheat-300">{{ __('Seguir') }}</dt>
                            <dd class="mt-2 flex gap-4 text-soil-200">
                                <a href="https://instagram.com/asfouri.media" class="hover:text-parchment" rel="noopener">Instagram</a>
                                <a href="https://www.linkedin.com/company/asfouri" class="hover:text-parchment" rel="noopener">LinkedIn</a>
                                <a href="https://bsky.app/profile/asfouri.media" class="hover:text-parchment" rel="noopener">Bluesky</a>
                            </dd>
                        </div>
                    </dl>

                    <p class="mt-8 border-t border-soil-700 pt-5 font-display text-lg italic text-wheat-200">{{ __('Enraizar e levantar voo.') }}</p>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.site>
