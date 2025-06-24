<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title>{{ $title ?? 'Desa Bantengputih - Kecamatan Karanggeneng, Kabupaten Lamongan' }}</title>
    <meta name="description"
        content="{{ $description ?? 'Website resmi Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan. Informasi pelayanan publik, berita desa, produk unggulan, dan transparansi pemerintahan desa.' }}">
    <meta name="keywords"
        content="{{ $keywords ?? 'desa bantengputih, karanggeneng, lamongan, pemerintah desa, pelayanan publik, berita desa, produk unggulan, transparansi desa, jawa timur' }}">
    <meta name="author" content="Pemerintah Desa Bantengputih">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $canonical ?? request()->url() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title"
        content="{{ $ogTitle ?? ($title ?? 'Desa Bantengputih - Kecamatan Karanggeneng, Kabupaten Lamongan') }}">
    <meta property="og:description"
        content="{{ $ogDescription ?? ($description ?? 'Website resmi Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan. Informasi pelayanan publik, berita desa, produk unggulan, dan transparansi pemerintahan desa.') }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Desa Bantengputih">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ request()->url() }}">
    <meta name="twitter:title"
        content="{{ $twitterTitle ?? ($title ?? 'Desa Bantengputih - Kecamatan Karanggeneng, Kabupaten Lamongan') }}">
    <meta name="twitter:description"
        content="{{ $twitterDescription ?? ($description ?? 'Website resmi Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan.') }}">
    <meta name="twitter:image" content="{{ $twitterImage ?? asset('images/og-image.jpg') }}">

    <!-- Local Business Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GovernmentOrganization",
        "name": "Pemerintah Desa Bantengputih",
        "alternateName": "Desa Bantengputih",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "Pemerintahan Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan, Jawa Timur",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Desa Bantengputih",
            "addressLocality": "Karanggeneng",
            "addressRegion": "Lamongan",
            "addressCountry": "ID"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "-7.2575",
            "longitude": "112.4262"
        },
        "telephone": "(0322) 123-4567",
        "email": "bantengputih@lamongan.go.id",
        "sameAs": [
            "https://www.facebook.com/desabantengputih",
            "https://www.instagram.com/desabantengputih"
        ]
    }
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#4CAF50">

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Head Content -->
    {{ $head ?? '' }}

    <!-- Google Analytics (replace with your GA4 tracking ID) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
</head>

<body class="font-poppins bg-gray-50">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 bg-green-600 text-white p-2 z-50">
        Skip to main content
    </a>

    <!-- Navigation -->
    <x-navigation />

    <!-- Main Content -->
    <main id="main-content" class="pt-16">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Additional Scripts -->
    @stack('scripts')

    <!-- Structured Data for Breadcrumbs (if applicable) -->
    @if (isset($breadcrumbs))
        <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            @foreach($breadcrumbs as $index => $breadcrumb)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "name": "{{ $breadcrumb['name'] }}",
                "item": "{{ $breadcrumb['url'] }}"
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
    @endif
</body>

</html>
