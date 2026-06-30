@props([
    'title' => null,
    'description' => null,
])

@php
    $appName = 'asfouri';
    $defaultDescription = __('Agência de comunicação regenerativa: estratégia, narrativa, redes sociais, plataformas web, IA, branding e ilustração para projetos que regeneram a terra e as comunidades.');
    $metaDescription = $description ?? $defaultDescription;
    $pageTitle = $title ? $title.' — '.$appName : $appName.' — '.__('comunicação regenerativa');
    $locale = app()->getLocale();
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}" class="antialiased">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#f7f3eb" />

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}" />

    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="pt" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}" />

    <meta property="og:type" content="website" />
    <meta property="og:locale" content="{{ $locale === 'pt' ? 'pt_PT' : 'en_GB' }}" />
    <meta property="og:title" content="{{ $title ?? $appName }}" />
    <meta property="og:description" content="{{ $metaDescription }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $appName }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title ?? $appName }}" />
    <meta name="twitter:description" content="{{ $metaDescription }}" />

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <a href="#main" class="skip-link">{{ __('Saltar para o conteúdo') }}</a>

    <x-site.header />

    <main id="main">
        {{ $slot }}
    </main>

    <x-site.footer />
</body>
</html>
