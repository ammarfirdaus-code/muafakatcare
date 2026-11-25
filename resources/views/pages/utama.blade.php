@extends('layouts.app')
@section('content')
@php
    $mc = config('muafakat');
    $slaid = $kempens->take(3);
    $adaAngka = $kaunter->whereNotNull('nilai')->isNotEmpty();
@endphp

{{-- 1. Hero slaid: satu slaid bagi setiap kempen aktif --}}
<section class="hero" aria-roledescription="carousel" aria-label="{{ __('Kempen Sedang Berlangsung') }}">
    <div class="slides" id="slides" tabindex="0">
        @forelse ($slaid as $k)
            <div class="slide @if ($loop->first) aktif @endif" role="group" aria-roledescription="slide" aria-label="{{ $loop->iteration }} / {{ $slaid->count() }}">
                <div class="wrap"><div class="sgrid">
                    <div>
                        @if ($k->label)<span class="eyebrow">{{ __($k->label) }}</span>@endif
                        <{{ $loop->first ? 'h1' : 'h2' }} class="hl"><mark>{{ __($k->hero_sorotan ?? $k->tajuk) }}</mark> {{ $k->hero_ayat ? __($k->hero_ayat) : '' }}</{{ $loop->first ? 'h1' : 'h2' }}>
                        <p class="hsub">{{ __($k->ringkas) }}</p>
                        <div class="cta">
                            <a class="btn btn-white" href="{{ $k->pautan_bcl ?? lr('infak') }}" rel="noopener">{{ __('Bantu Mereka') }}</a>
                            <a class="btn btn-ghost" href="{{ $k->program ? lr('program', $k->program) : lr('impak') }}">{{ __('Ketahui Selanjutnya') }}</a>
                        </div>
                    </div>
                    <div class="svis">
                        @if ($k->gambar)<div class="thumb"><img src="{{ asset($k->gambar) }}" alt="{{ __($k->tajuk) }}"></div>@endif
                        <span class="pill">{{ __($k->program?->nama ?? 'Kempen') }}</span>
                        <h3>{{ __($k->tajuk) }}</h3>
                        @if ($k->sasaran)
                            <div class="progress"><span style="width: {{ $k->peratus() ?? 0 }}%"></span></div>
                            <p class="muted">
                                @if ($k->terkumpul !== null) {{ __(':a daripada :b', ['a' => $k->format($k->terkumpul), 'b' => $k->format($k->sasaran)]) }} · {{ $k->peratus() }}%
                                @else {{ __('Sasaran :b · kemajuan dikemas kini setiap hari', ['b' => $k->format($k->sasaran)]) }} @endif
                            </p>
                        @endif
                        <ul class="ticks">
                            <li>{{ __('Pertubuhan berdaftar') }} {{ $mc['no_ppm'] }}</li>
                            <li>{{ __('Infak melalui saluran rasmi pertubuhan sahaja') }}</li>
                            <li>{{ __('Setiap agihan direkod di Papan Impak') }}</li>
                        </ul>
                    </div>
                </div></div>
            </div>
        @empty
            <div class="slide"><div class="wrap"><div class="sgrid"><div>
                <h1 class="hl"><mark>{{ $mc['nama'] }}</mark> {{ $mc['tagline'] }}</h1>
                <p class="hsub">{{ __($mc['pengenalan']) }}</p>
                <div class="cta"><a class="btn btn-white" href="{{ lr('infak') }}">{{ __('Bantu Mereka') }}</a><a class="btn btn-ghost" href="{{ lr('tentang') }}">{{ __('Ketahui Selanjutnya') }}</a></div>
            </div></div></div></div>
        @endforelse
    </div>
    @if ($slaid->count() > 1)
        <button class="sarrow prev" type="button" aria-label="{{ __('Slaid sebelumnya') }}" data-arah="-1">‹</button>
        <button class="sarrow next" type="button" aria-label="{{ __('Slaid seterusnya') }}" data-arah="1">›</button>
        <div class="dots">@foreach ($slaid as $k)<button type="button" aria-label="{{ $loop->iteration }}: {{ __($k->tajuk) }}" @if ($loop->first) aria-current="true" @endif></button>@endforeach</div>
    @endif
</section>

{{-- 2. Tiga kotak pautan --}}
<section class="trio">
    <div class="wrap">
        <a href="{{ lr('tentang') }}"><h3><span>➤</span>{{ __('Ketahui Tentang Kami') }}</h3><p>{{ __('Jom kenali Muafakat Care dan lihat sendiri kebaikan yang boleh kita usahakan bersama.') }}</p></a>
        <a href="{{ lr('impak') }}"><h3><span>✓</span>{{ __('Lihat Impak Kami') }}</h3><p>{{ __('Laporan agihan dengan tarikh, angka dan pautan ke hebahan asal.') }}</p></a>
        <a href="#kempen"><h3><span>➤</span>{{ __('Kempen Sedang Berlangsung') }}</h3><p>{{ __('Pilih kempen yang sedang berjalan dan salurkan infak anda hari ini.') }}</p></a>
    </div>
</section>

{{-- 3. Misi + mozek program --}}
<section class="section">
    <div class="wrap">
        <div class="shead">
            <h2>{{ __('MISI KAMI') }}</h2>
            <p>{{ __($mc['misi'][0]) }}</p>
            <p>{{ __($mc['misi'][1]) }}</p>
        </div>
        <div class="mozek">
            @foreach ($programs as $p)
                <div class="mcol @if ($loop->even) songsang @endif">
                    <a class="mp" href="{{ lr('program', $p) }}">
                        <span class="ic" aria-hidden="true">{{ $p->ikon }}</span>
                        <h3>{{ __($p->nama) }}</h3>
                        <p>{{ __($p->satu_baris) }}</p>
                    </a>
                    @if ($p->gambar)
                        <a class="mk foto" href="{{ lr('program', $p) }}"><img src="{{ asset($p->gambar) }}" alt="{{ __($p->nama) }}" loading="lazy">@if ($p->kos_seunit)<span>{{ __($p->kos_seunit) }}</span>@endif</a>
                    @elseif ($p->kos_seunit)
                        <a class="mk" href="{{ lr('program', $p) }}"><small>{{ __('Kos') }}</small><strong>{{ __($p->kos_seunit) }}</strong><span>{{ __('Baca lagi') }} →</span></a>
                    @else
                        <a class="mk" href="{{ lr('mohon-bantuan') }}"><small>{{ __('Untuk penerima') }}</small><strong>{{ __('Perlukan bantuan ini?') }}</strong><span>{{ __('Mohon Bantuan') }} →</span></a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 4. Statistik bantuan --}}
<section class="stat">
    <div class="wrap">
        <div>
            <h2>{{ __('Statistik bantuan') }}</h2>
            <p>{{ __('Bantuan yang telah disalurkan melalui kesemua program Muafakat Care.') }}
                {{ $adaAngka ? __('Dikemas kini').': '.$kaunter->max('updated_at')->format('d/m/Y').'.' : __('Angka rasmi sedang disemak dengan rekod bank dan akan dikemas kini.') }}</p>
        </div>
        <div class="snum">
            @foreach ($kaunter as $c)
                <div>
                    @if ($c->nilai !== null)<strong data-kira="{{ $c->nilai }}">{{ number_format($c->nilai) }}</strong>@else<strong class="tunggu">{{ __('Akan dikemas kini') }}</strong>@endif
                    <span>{{ __($c->label) }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 5. Kempen --}}
<section class="section alt" id="kempen">
    <div class="wrap">
        <h2>{{ __('Kempen Sedang Berlangsung') }}</h2>
        <p class="lead">{{ __('Ayuh lakukan kebaikan melalui kempen-kempen yang sedang berjalan.') }}</p>
        <div class="grid gk" style="margin-top:24px">
            @foreach ($kempens as $k) @include('components.kempen-card', ['k' => $k]) @endforeach
        </div>
    </div>
</section>

{{-- 6. Aktiviti & hebahan (laporan agihan yang diterbitkan) --}}
<section class="section">
    <div class="wrap">
        <h2>{{ __('Aktiviti & Hebahan') }}</h2>
        @if ($laporan->isNotEmpty())
            @php $utama = $laporan->first(); @endphp
            <div class="berita">
                <article class="butama"><a href="{{ lr('impak.bulan', $utama->bulan) }}">
                    <span class="tag">{{ __($utama->program?->nama ?? 'Laporan agihan') }}</span>
                    <h3>{{ __($utama->tajuk) }}</h3>
                    <p class="muted">{{ $utama->tarikh_agihan?->format('d/m/Y') ?? \Carbon\Carbon::parse($utama->bulan.'-01')->translatedFormat('F Y') }} @if ($utama->lokasi) · {{ $utama->lokasi }} @endif</p>
                    <div class="thumb">@if (!empty($utama->gambar[0]))<img src="{{ asset($utama->gambar[0]) }}" alt="{{ __($utama->tajuk) }}" loading="lazy">@else<span>@if ($utama->penerima !== null){{ $utama->penerima }} {{ __('penerima') }} @else {{ __($utama->tajuk) }} @endif</span>@endif</div>
                </a></article>
                <div class="bsen">
                    @foreach ($laporan->skip(1) as $r)
                        <article><a href="{{ lr('impak.bulan', $r->bulan) }}">
                            <div class="thumb">@if (!empty($r->gambar[0]))<img src="{{ asset($r->gambar[0]) }}" alt="{{ __($r->tajuk) }}" loading="lazy">@else<span>{{ __($r->program?->nama ?? 'Agihan') }}</span>@endif</div>
                            <div><span class="tag">{{ __($r->program?->nama ?? 'Laporan agihan') }}</span><h3>{{ __($r->tajuk) }}</h3><p class="muted" style="margin:0">{{ $r->tarikh_agihan?->format('d/m/Y') ?? \Carbon\Carbon::parse($r->bulan.'-01')->translatedFormat('F Y') }}</p></div>
                        </a></article>
                    @endforeach
                </div>
            </div>
        @else
            <div class="kosong"><p style="margin:0">{{ __('Laporan agihan bulanan akan dipaparkan di sini, lengkap dengan tarikh, bilangan penerima dan kos.') }}</p></div>
        @endif
        <div class="ikuti">
            <a class="btn btn-line" href="{{ lr('impak') }}">{{ __('Lihat semua laporan') }}</a>
            @foreach ($mc['sosial'] as $nama => $url)<a class="btn btn-line" href="{{ $url }}" rel="noopener">@include('components.ikon', ['nama' => $nama]){{ __('Ikuti kami di :nama', ['nama' => $nama]) }}</a>@endforeach
        </div>
    </div>
</section>

{{-- 7. Ketelusan --}}
<section class="section alt">
    <div class="wrap">
        <h2>{{ __('Bagaimana infak anda sampai') }}</h2>
        <ol class="steps grid g4">
            <li><strong>{{ __('Anda infak') }}</strong><span>{{ __('Melalui BCL, pindahan bank atau QR DuitNow.') }}</span></li>
            <li><strong>{{ __('Kami rekod') }}</strong><span>{{ __('Setiap ringgit masuk ke buku tunai pertubuhan.') }}</span></li>
            <li><strong>{{ __('Sukarelawan salurkan') }}</strong><span>{{ __('Barang dibeli, dibungkus dan dihantar ke rumah penerima.') }}</span></li>
            <li><strong>{{ __('Laporan dikongsi') }}</strong><span>{{ __('Gambar dan angka agihan di Papan Impak.') }}</span></li>
        </ol>
    </div>
</section>

@if ($slaid->count() > 1)
<script>
(function () {
    var el = document.getElementById('slides'), hero = el.parentElement;
    var dots = hero.querySelectorAll('.dots button'), n = dots.length, jeda = false;
    var tenang = matchMedia('(prefers-reduced-motion: reduce)').matches;
    function kini() { return Math.round(el.scrollLeft / el.clientWidth); }
    function ke(i) { el.scrollTo({ left: ((i + n) % n) * el.clientWidth, behavior: tenang ? 'auto' : 'smooth' }); }
    hero.querySelectorAll('.sarrow').forEach(function (b) { b.addEventListener('click', function () { ke(kini() + Number(b.dataset.arah)); }); });
    dots.forEach(function (d, i) { d.addEventListener('click', function () { ke(i); }); });
    var sl = el.querySelectorAll('.slide');
    function tanda() { var k = kini(); dots.forEach(function (d, i) { d.setAttribute('aria-current', i === k ? 'true' : 'false'); }); sl.forEach(function (x, i) { x.classList.toggle('aktif', i === k); }); }
    el.addEventListener('scroll', tanda, { passive: true }); tanda();
    ['mouseenter', 'focusin', 'touchstart'].forEach(function (e) { hero.addEventListener(e, function () { jeda = true; }, { passive: true }); });
    ['mouseleave', 'focusout'].forEach(function (e) { hero.addEventListener(e, function () { jeda = false; }); });
    if (!tenang) setInterval(function () { if (!jeda && !document.hidden) ke(kini() + 1); }, 7000);
})();
</script>
@endif
@endsection
