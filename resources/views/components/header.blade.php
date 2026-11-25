@php
    $menu = ['/' => 'Utama', '/tentang' => 'Tentang Kami', '/program/foodbank' => 'Program Kami', '/sukarelawan' => 'Sertai Kami', '/impak' => 'Impak', '/hubungi' => 'Hubungi Kami'];
    $kini = '/'.ltrim(request()->path(), '/');
@endphp
<header class="hdr @if (request()->routeIs('utama')) atas @endif">
    <div class="wrap bar">
        <a href="{{ url('/') }}" class="brand" aria-label="{{ config('muafakat.nama') }}"><img src="{{ asset('img/logo.png') }}" alt="{{ config('muafakat.nama') }}" height="48"></a>
        <nav class="nav" id="nav">
            @foreach ($menu as $href => $label)
                <a href="{{ url($href) }}" @if ($kini === $href) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>
        <div class="act">
            <a class="btn btn-red" href="{{ route('infak') }}">Jom Infak</a>
            <button class="burger" aria-label="Menu" aria-controls="nav" onclick="document.getElementById('nav').classList.toggle('open')">☰</button>
        </div>
    </div>
</header>
