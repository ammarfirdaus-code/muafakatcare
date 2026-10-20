@php
    $menu = ['/' => 'Utama', '/program/foodbank' => 'Program', '/impak' => 'Impak', '/tentang' => 'Tentang Kami', '/soalan-lazim' => 'Soalan Lazim', '/hubungi' => 'Hubungi'];
    $kini = '/'.ltrim(request()->path(), '/');
@endphp
<header class="hdr">
    <div class="wrap bar">
        <a href="{{ url('/') }}" class="brand" aria-label="{{ config('muafakat.nama') }}"><img src="{{ asset('img/logo.png') }}" alt="{{ config('muafakat.nama') }}" height="44"></a>
        <nav class="nav" id="nav">
            @foreach ($menu as $href => $label)
                <a href="{{ url($href) }}" @if ($kini === $href) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>
        <div class="act">
            <a class="btn btn-red" href="{{ route('infak') }}">Infak</a>
            <button class="burger" aria-label="Menu" aria-controls="nav" onclick="document.getElementById('nav').classList.toggle('open')">☰</button>
        </div>
    </div>
</header>
