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
                    <div class="relative overflow-hidden rounded-2xl border border-blue-200 bg-blue-50 p-8 text-center" role="status">
                        <span class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-sun/60" aria-hidden="true"></span>
                        <span class="relative mx-auto inline-flex h-14 w-14 items-center justify-center rounded-full bg-blue-500 text-cream">
                            <x-ui.icon name="check" class="h-7 w-7" />
                        </span>
                        <h2 class="relative mt-5 font-display text-2xl font-semibold text-blue-500">{{ __('Mensagem semeada!') }}</h2>
                        <p class="relative mt-2 text-ink/70">{{ __('Obrigado pelo seu contacto. Respondemos dentro de poucos dias úteis.') }}</p>
                        <div class="relative mt-6">
                            <x-ui.button :href="route('home')" variant="outline">{{ __('Voltar ao início') }}</x-ui.button>
                        </div>
                    </div>
                @else
                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-coral bg-coral-soft/30 p-4 text-sm font-medium text-blue-800" role="alert">
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
                                <label for="name" class="block text-sm font-semibold text-blue-800">{{ __('Nome') }} <span class="text-gold">*</span></label>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                       class="mt-2 w-full rounded-xl border border-cream-deep bg-paper px-4 py-3 text-ink placeholder:text-ink/40 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                       placeholder="{{ __('O seu nome') }}" />
                                @error('name') <p class="mt-1.5 text-sm text-gold">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-blue-800">{{ __('Email') }} <span class="text-gold">*</span></label>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                       class="mt-2 w-full rounded-xl border border-cream-deep bg-paper px-4 py-3 text-ink placeholder:text-ink/40 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                       placeholder="nome@exemplo.pt" />
                                @error('email') <p class="mt-1.5 text-sm text-gold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="organisation" class="block text-sm font-semibold text-blue-800">{{ __('Organização') }}</label>
                                <input id="organisation" name="organisation" type="text" value="{{ old('organisation') }}"
                                       class="mt-2 w-full rounded-xl border border-cream-deep bg-paper px-4 py-3 text-ink placeholder:text-ink/40 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                       placeholder="{{ __('Projeto, marca ou coletivo') }}" />
                                @error('organisation') <p class="mt-1.5 text-sm text-gold">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-blue-800">{{ __('Assunto') }}</label>
                                <input id="subject" name="subject" type="text" value="{{ old('subject') }}"
                                       class="mt-2 w-full rounded-xl border border-cream-deep bg-paper px-4 py-3 text-ink placeholder:text-ink/40 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                       placeholder="{{ __('Em que podemos ajudar?') }}" />
                                @error('subject') <p class="mt-1.5 text-sm text-gold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-blue-800">{{ __('Mensagem') }} <span class="text-gold">*</span></label>
                            <textarea id="message" name="message" rows="6" required
                                      class="mt-2 w-full rounded-xl border border-cream-deep bg-paper px-4 py-3 text-ink placeholder:text-ink/40 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                      placeholder="{{ __('Conte-nos sobre o seu projeto, os seus objetivos e o que procura.') }}">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1.5 text-sm text-gold">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-wrap items-center gap-4">
                            <x-ui.button size="lg">{{ __('Enviar mensagem') }}</x-ui.button>
                            <p class="text-xs text-ink/55">{{ __('Ao enviar, concorda em ser contactado a respeito do seu pedido.') }}</p>
                        </div>
                    </form>
                @endif
            </div>

            {{-- Sidebar — bold blue card --}}
            <aside class="order-1 lg:order-2">
                <div class="relative overflow-hidden rounded-2xl bg-blue-500 p-8 text-cream">
                    {{-- decorative rising sun + drifting sparrow --}}
                    <span class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-sun/20" aria-hidden="true"></span>
                    <x-brand.mark class="animate-drift pointer-events-none absolute right-5 top-6 h-24 w-auto text-blue-400/50" />

                    <x-brand.mark class="relative h-12 w-auto text-cream" />
                    <h2 class="relative mt-6 font-display text-2xl font-semibold text-paper">{{ __('Prefere falar diretamente?') }}</h2>
                    <p class="relative mt-3 text-sm leading-relaxed text-cream/85">{{ __('Escreva-nos por email ou siga-nos. Estamos sempre abertos a conhecer projetos que regeneram.') }}</p>

                    <dl class="relative mt-8 space-y-5 text-sm">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-sun">{{ __('Email') }}</dt>
                            <dd class="mt-1"><a href="mailto:hello@asfouri.media" class="text-paper underline decoration-sun/50 underline-offset-4 transition hover:decoration-sun">hello@asfouri.media</a></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-sun">{{ __('Onde estamos') }}</dt>
                            <dd class="mt-1 text-cream/85">{{ __('Portugal · a trabalhar com o mundo') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-[0.16em] text-sun">{{ __('Seguir') }}</dt>
                            <dd class="mt-2 flex gap-4 text-cream/85">
                                <a href="https://instagram.com/asfouri.media" class="transition hover:text-paper" rel="noopener">Instagram</a>
                                <a href="https://www.linkedin.com/company/asfouri" class="transition hover:text-paper" rel="noopener">LinkedIn</a>
                                <a href="https://bsky.app/profile/asfouri.media" class="transition hover:text-paper" rel="noopener">Bluesky</a>
                            </dd>
                        </div>
                    </dl>

                    <p class="relative mt-8 border-t border-blue-400/40 pt-5 font-display text-lg font-medium text-sun">{{ __('Enraizar e levantar voo.') }}</p>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.site>
