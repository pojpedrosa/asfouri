@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'ogType' => 'website',
])

@php
    $appName = 'asfouri';
    $defaultDescription = __('Agência de comunicação regenerativa: estratégia, narrativa, tecnologia e design para projetos que regeneram a terra e as comunidades.');
    $metaDescription = filled($description) ? $description : $defaultDescription;
    $pageTitle = $title ? $title.' — '.$appName : $appName.' — '.__('comunicação regenerativa');
    $locale = app()->getLocale();
    $ogImage = $image ?: asset('brand/og-default.png');

    $organizationLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'asfouri',
        'url' => url('/'),
        'logo' => asset('brand/asfouri-icon.svg'),
        'image' => asset('brand/og-default.png'),
        'description' => $defaultDescription,
        'email' => 'hello@asfouri.media',
        'foundingLocation' => ['@type' => 'Country', 'name' => 'Portugal'],
        'sameAs' => [
            'https://instagram.com/asfouri.media',
            'https://www.linkedin.com/company/asfouri',
            'https://bsky.app/profile/asfouri.media',
        ],
    ];
    $websiteLd = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'asfouri',
        'url' => url('/'),
        'inLanguage' => $locale === 'pt' ? 'pt-PT' : 'en-GB',
    ];
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

    <meta property="og:type" content="{{ $ogType }}" />
    <meta property="og:locale" content="{{ $locale === 'pt' ? 'pt_PT' : 'en_GB' }}" />
    <meta property="og:title" content="{{ $title ? $title.' — '.$appName : $pageTitle }}" />
    <meta property="og:description" content="{{ $metaDescription }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $appName }}" />
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt" content="asfouri — {{ __('comunicação regenerativa') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title ?? $appName }}" />
    <meta name="twitter:description" content="{{ $metaDescription }}" />
    <meta name="twitter:image" content="{{ $ogImage }}" />

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="alternate" type="application/rss+xml" title="asfouri — {{ __('Jornal') }}" href="{{ url('/jornal/feed') }}" />

    <script type="application/ld+json">{!! json_encode($organizationLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($websiteLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('head')

    {{ \Illuminate\Support\Facades\Vite::fonts() }}
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
