@php
    $mc = config('muafakat');
    $en = app()->getLocale() === 'en';
    $tajukPenuh = isset($title) ? __($title)." | {$mc['nama']}" : "{$mc['nama']} | {$mc['tagline']}";
    $desc = __($description ?? $mc['pengenalan']);
    $laluan = request()->route();
    $asas = preg_replace('/^en\./', '', $laluan?->getName() ?? '') ?: 'utama';
    $ada = \Illuminate\Support\Facades\Route::has($asas) && ! str_ends_with($asas, '.hantar');
    $urlMs = $ada ? route($asas, $laluan?->parameters() ?? []) : route('utama');
    $urlEn = $ada ? route('en.'.$asas, $laluan?->parameters() ?? []) : route('en.utama');
    $ngo = [
        '@context' => 'https://schema.org', '@type' => 'NGO',
        'name' => $mc['nama'], 'alternateName' => $mc['nama_pertubuhan'],
        'url' => url('/'), 'logo' => asset('img/logo.png'),
        'identifier' => $mc['no_ppm'], 'description' => __($mc['pengenalan']),
        'areaServed' => $mc['kawasan'], 'sameAs' => array_values($mc['sosial']),
        'email' => $mc['emel'], 'address' => $mc['alamat'],
    ];
@endphp
<!doctype html>
<html lang="{{ $en ? 'en' : 'ms' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tajukPenuh }}</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="ms" href="{{ $urlMs }}">
    <link rel="alternate" hreflang="en" href="{{ $urlEn }}">
    <link rel="alternate" hreflang="x-default" href="{{ $urlMs }}">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <meta property="og:title" content="{{ $tajukPenuh }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">
    <meta property="og:locale" content="{{ $en ? 'en_MY' : 'ms_MY' }}">
    <meta name="theme-color" content="#C5162E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <script type="application/ld+json">{!! json_encode($ngo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    <script>document.documentElement.classList.add('js')</script>
    @stack('schema')
</head>
<body>
    @include('components.header', ['urlMs' => $urlMs, 'urlEn' => $urlEn])
    <main>@yield('content')</main>
    @include('components.footer')
    <script>
    (function () {
        var tenang = matchMedia('(prefers-reduced-motion: reduce)').matches;
        var sasaran = document.querySelectorAll('.shead, .mcol, .trio a, .stat .wrap > div, .kc, .card, .berita > *, .kosong, .steps li, .section h2, .page-head .wrap > *, .ftr .cols > div');
        if (tenang || !('IntersectionObserver' in window)) return;
        function kira(el) {
            var akhir = Number(el.dataset.kira), mula = performance.now();
            (function langkah(t) { var p = Math.min(1, (t - mula) / 1400), n = Math.round(akhir * (1 - Math.pow(1 - p, 3))); el.textContent = n.toLocaleString('en-MY'); if (p < 1) requestAnimationFrame(langkah); })(mula);
        }
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) {
                if (!e.isIntersecting) return;
                e.target.classList.add('nampak');
                e.target.querySelectorAll('[data-kira]').forEach(kira);
                io.unobserve(e.target);
                setTimeout(function () { e.target.classList.remove('gerak', 'nampak'); e.target.style.transitionDelay = ''; }, 1500);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        sasaran.forEach(function (el) {
            var adik = Array.prototype.indexOf.call(el.parentElement.children, el);
            el.classList.add('gerak'); el.style.transitionDelay = Math.min(adik, 5) * 90 + 'ms';
            io.observe(el);
        });
    })();
    </script>
</body>
</html>
