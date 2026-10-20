@php
    $mc = config('muafakat');
    $tajukPenuh = isset($title) ? "$title | {$mc['nama']}" : "{$mc['nama']} | {$mc['tagline']}";
    $desc = $description ?? $mc['pengenalan'];
    $ngo = [
        '@context' => 'https://schema.org', '@type' => 'NGO',
        'name' => $mc['nama'], 'alternateName' => $mc['nama_pertubuhan'],
        'url' => url('/'), 'logo' => asset('img/logo.png'),
        'identifier' => $mc['no_ppm'], 'description' => $mc['pengenalan'],
        'areaServed' => $mc['kawasan'], 'sameAs' => array_values($mc['sosial']),
    ];
@endphp
<!doctype html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tajukPenuh }}</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <meta property="og:title" content="{{ $tajukPenuh }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">
    <meta property="og:locale" content="ms_MY">
    <meta name="theme-color" content="#C5162E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <script type="application/ld+json">{!! json_encode($ngo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @stack('schema')
</head>
<body>
    @include('components.header')
    <main>@yield('content')</main>
    @include('components.footer')
</body>
</html>
