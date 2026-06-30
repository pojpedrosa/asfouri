<!DOCTYPE html>
<html lang="pt" class="antialiased">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Link de acesso — asfouri</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-cream text-ink">
    <div class="grain relative flex min-h-screen items-center justify-center overflow-hidden px-5 py-12">
        {{-- Playful geometric brand accents --}}
        <div aria-hidden="true" class="pointer-events-none absolute -left-20 -top-16 h-64 w-64 rounded-full bg-sun/40"></div>
        <div aria-hidden="true" class="pointer-events-none absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-sky-soft/60"></div>

        <div class="relative w-full max-w-md">
            <a href="{{ route('home') }}" class="mb-8 flex items-center justify-center gap-2.5 text-blue-500">
                <x-brand.mark class="h-10 w-auto" :sun="true" />
                <span class="font-wordmark text-2xl lowercase text-ink">asfouri</span>
            </a>

            <div class="rounded-3xl border border-sky bg-paper p-8 shadow-sm">
                @if (session('magic_sent'))
                    <div class="text-center">
                        <span class="mx-auto inline-flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-500">
                            <x-ui.icon name="check" class="h-6 w-6" />
                        </span>
                        <h1 class="mt-5 font-display text-2xl font-semibold tracking-tight text-blue-500">Verifique o seu email</h1>
                        <p class="mt-2 text-pretty text-sm leading-relaxed text-ink/70">
                            Se existir uma conta com esse endereço, enviámos um link de acesso. É válido durante 30 minutos e só pode ser usado uma vez.
                        </p>
                        <a href="{{ route('magic.request') }}" class="mt-6 inline-block text-sm font-semibold text-blue-500 hover:text-blue-700">← Enviar outro link</a>
                    </div>
                @else
                    <h1 class="font-display text-2xl font-semibold tracking-tight text-blue-500">Entrar com link mágico</h1>
                    <p class="mt-2 text-sm leading-relaxed text-ink/70">
                        Indique o seu email e enviamos-lhe um link para entrar no back office — sem palavra-passe.
                    </p>

                    @if (session('magic_invalid'))
                        <div class="mt-5 rounded-xl border border-coral bg-coral-soft/30 px-4 py-3 text-sm text-ink">
                            Esse link já foi usado ou expirou. Peça um novo abaixo.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('magic.send') }}" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-semibold text-ink">Email</label>
                            <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                                   class="mt-2 w-full rounded-xl border border-sky bg-cream px-4 py-3 text-ink placeholder:text-ink/40 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                   placeholder="nome@asfouri.media" />
                            @error('email') <p class="mt-1.5 text-sm text-coral">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full rounded-full bg-blue-500 px-6 py-3 text-sm font-semibold text-cream transition hover:bg-blue-700">
                            Enviar link de acesso
                        </button>
                    </form>
                @endif

                <p class="mt-6 border-t border-sky-soft pt-5 text-center text-sm">
                    <a href="{{ url('/admin/login') }}" class="font-medium text-ink/50 hover:text-blue-500">Entrar com palavra-passe</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
