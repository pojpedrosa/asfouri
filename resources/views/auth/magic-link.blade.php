<!DOCTYPE html>
<html lang="pt" class="antialiased">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Link de acesso — asfouri</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-parchment text-soil-900">
    <div class="grain flex min-h-screen items-center justify-center px-5 py-12">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="mb-8 flex items-center justify-center gap-2.5 text-soil-900">
                <x-brand.mark class="h-10 w-auto" />
                <span class="font-display text-2xl font-medium lowercase tracking-tight">asfouri</span>
            </a>

            <div class="rounded-2xl border border-soil-100 bg-white/70 p-8 shadow-sm backdrop-blur">
                @if (session('magic_sent'))
                    <div class="text-center">
                        <span class="mx-auto inline-flex h-12 w-12 items-center justify-center rounded-full bg-moss-100 text-moss-700">
                            <x-ui.icon name="check" class="h-6 w-6" />
                        </span>
                        <h1 class="mt-5 font-display text-2xl text-soil-900">Verifique o seu email</h1>
                        <p class="mt-2 text-pretty text-sm leading-relaxed text-soil-600">
                            Se existir uma conta com esse endereço, enviámos um link de acesso. É válido durante 30 minutos e só pode ser usado uma vez.
                        </p>
                        <a href="{{ route('magic.request') }}" class="mt-6 inline-block text-sm font-semibold text-clay-600 hover:text-clay-700">← Enviar outro link</a>
                    </div>
                @else
                    <h1 class="font-display text-2xl text-soil-900">Entrar com link mágico</h1>
                    <p class="mt-2 text-sm leading-relaxed text-soil-600">
                        Indique o seu email e enviamos-lhe um link para entrar no back office — sem palavra-passe.
                    </p>

                    @if (session('magic_invalid'))
                        <div class="mt-5 rounded-xl border border-clay-300 bg-clay-50 px-4 py-3 text-sm text-clay-800">
                            Esse link já foi usado ou expirou. Peça um novo abaixo.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('magic.send') }}" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-semibold text-soil-800">Email</label>
                            <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                                   class="mt-2 w-full rounded-xl border border-soil-200 bg-parchment px-4 py-3 text-soil-900 placeholder:text-soil-400 focus:border-clay-400 focus:outline-none focus:ring-2 focus:ring-clay-200"
                                   placeholder="nome@asfouri.media" />
                            @error('email') <p class="mt-1.5 text-sm text-clay-600">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full rounded-full bg-clay-500 px-6 py-3 text-sm font-semibold text-parchment transition hover:bg-clay-600">
                            Enviar link de acesso
                        </button>
                    </form>
                @endif

                <p class="mt-6 border-t border-soil-100 pt-5 text-center text-sm">
                    <a href="{{ url('/admin/login') }}" class="font-medium text-soil-500 hover:text-soil-800">Entrar com palavra-passe</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
