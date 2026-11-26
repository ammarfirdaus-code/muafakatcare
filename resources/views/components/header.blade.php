@php
    $en = app()->getLocale() === 'en';
    $menu = ['utama' => 'Utama', 'tentang' => 'Tentang Kami', 'program' => 'Program Kami', 'impak' => 'Impak', 'ebook' => 'eBook Percuma', 'hubungi' => 'Hubungi Kami'];
    $kini = preg_replace('/^en\./', '', request()->route()?->getName() ?? '');
@endphp
<header class="hdr @if ($kini === 'utama') atas @endif">
    <div class="wrap bar">
        <a href="{{ lr('utama') }}" class="brand" aria-label="{{ config('muafakat.nama') }}"><img src="{{ asset('img/logo.png') }}" alt="{{ config('muafakat.nama') }}" height="48"></a>
        <nav class="nav" id="nav">
            @foreach ($menu as $nama => $label)
                <a href="{{ $nama === 'program' ? lr('program', 'foodbank') : lr($nama) }}" @if ($kini === $nama) aria-current="page" @endif>{{ __($label) }}</a>
            @endforeach
        </nav>
        <div class="act">
            <div class="bahasa" role="group" aria-label="{{ __('Bahasa') }}">
                <a href="{{ $urlMs }}" hreflang="ms" lang="ms" @if (! $en) aria-current="true" @endif>BM</a>
                <a href="{{ $urlEn }}" hreflang="en" lang="en" @if ($en) aria-current="true" @endif>EN</a>
            </div>
            <a class="btn btn-red" href="{{ lr('infak') }}">{{ __('Jom Infak') }}</a>
            <button class="burger" aria-label="Menu" aria-controls="nav" onclick="document.getElementById('nav').classList.toggle('open')">☰</button>
        </div>
    </div>
</header>
