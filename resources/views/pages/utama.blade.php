@extends('layouts.app')
@section('content')
@php
    $mc = config('muafakat');
    $slaid = $kempens->take(3);
    $adaAngka = $kaunter->whereNotNull('nilai')->isNotEmpty();
@endphp

{{-- 1. Hero slaid: satu slaid bagi setiap kempen aktif --}}
<section class="hero" aria-roledescription="carousel" aria-label="Kempen sedang berlangsung">
    <div class="slides" id="slides" tabindex="0">
        @forelse ($slaid as $k)
            <div class="slide" role="group" aria-roledescription="slaid" aria-label="{{ $loop->iteration }} daripada {{ $slaid->count() }}">
                <div class="wrap"><div class="sgrid">
                    <div>
                        @if ($k->label)<span class="eyebrow">{{ $k->label }}</span>@endif
                        <{{ $loop->first ? 'h1' : 'h2' }} class="hl"><mark>{{ $k->hero_sorotan ?? $k->tajuk }}</mark> {{ $k->hero_ayat }}</{{ $loop->first ? 'h1' : 'h2' }}>
                        <p class="hsub">{{ $k->ringkas }}</p>
                        <div class="cta">
                            <a class="btn btn-white" href="{{ $k->pautan_bcl ?? route('infak') }}" rel="noopener">Bantu Mereka</a>
                            <a class="btn btn-ghost" href="{{ $k->program ? route('program', $k->program) : route('impak') }}">Ketahui Selanjutnya</a>
                        </div>
                    </div>
                    <div class="svis">
                        @if ($k->gambar)<div class="thumb"><img src="{{ asset($k->gambar) }}" alt="{{ $k->tajuk }}"></div>@endif
                        <span class="pill">{{ $k->program?->nama ?? 'Kempen' }}</span>
                        <h3>{{ $k->tajuk }}</h3>
                        @if ($k->sasaran)
                            <div class="progress"><span style="width: {{ $k->peratus() ?? 0 }}%"></span></div>
                            <p class="muted">
                                @if ($k->terkumpul !== null) {{ $k->format($k->terkumpul) }} daripada {{ $k->format($k->sasaran) }} · {{ $k->peratus() }}%
                                @else Sasaran {{ $k->format($k->sasaran) }} · kemajuan akan dikemas kini @endif
                            </p>
                        @endif
                        <ul class="ticks">
                            <li>Pertubuhan berdaftar {{ $mc['no_ppm'] }}</li>
                            <li>Infak melalui saluran rasmi pertubuhan sahaja</li>
                            <li>Setiap agihan direkod di Papan Impak</li>
                        </ul>
                    </div>
                </div></div>
            </div>
        @empty
            <div class="slide"><div class="wrap"><div class="sgrid"><div>
                <h1 class="hl"><mark>{{ $mc['nama'] }}</mark> {{ $mc['tagline'] }}</h1>
                <p class="hsub">{{ $mc['pengenalan'] }}</p>
                <div class="cta"><a class="btn btn-white" href="{{ route('infak') }}">Bantu Mereka</a><a class="btn btn-ghost" href="{{ route('tentang') }}">Ketahui Selanjutnya</a></div>
            </div></div></div></div>
        @endforelse
    </div>
    @if ($slaid->count() > 1)
        <button class="sarrow prev" type="button" aria-label="Slaid sebelumnya" data-arah="-1">‹</button>
        <button class="sarrow next" type="button" aria-label="Slaid seterusnya" data-arah="1">›</button>
        <div class="dots">@foreach ($slaid as $k)<button type="button" aria-label="Slaid {{ $loop->iteration }}: {{ $k->tajuk }}" @if ($loop->first) aria-current="true" @endif></button>@endforeach</div>
    @endif
</section>

{{-- 2. Tiga kotak pautan --}}
<section class="trio">
    <div class="wrap">
        <a href="{{ route('tentang') }}"><h3><span>➤</span>Ketahui Tentang Kami</h3><p>Jom kenali {{ $mc['nama'] }} dan lihat sendiri kebaikan yang boleh kita usahakan bersama.</p></a>
        <a href="#sukarelawan"><h3><span>☺</span>Sertai Sukarelawan</h3><p>Bungkus, hantar, ziarah. Mari turun padang bersama pasukan kami.</p></a>
        <a href="#kempen"><h3><span>➤</span>Kempen Sedang Berlangsung</h3><p>Pilih kempen yang sedang berjalan dan salurkan infak anda hari ini.</p></a>
    </div>
</section>

{{-- 3. Misi + mozek program --}}
<section class="section">
    <div class="wrap">
        <div class="shead">
            <h2>MISI KAMI</h2>
            <p>{{ $mc['misi'][0] }}</p>
            <p>{{ $mc['misi'][1] }}</p>
        </div>
        <div class="mozek">
            @foreach ($programs as $p)
                <div class="mcol @if ($loop->even) songsang @endif">
                    <a class="mp" href="{{ route('program', $p) }}">
                        <span class="ic" aria-hidden="true">{{ $p->ikon }}</span>
                        <h3>{{ $p->nama }}</h3>
                        <p>{{ $p->satu_baris }}</p>
                    </a>
                    @if ($p->gambar)
                        <a class="mk foto" href="{{ route('program', $p) }}"><img src="{{ asset($p->gambar) }}" alt="{{ $p->nama }}" loading="lazy">@if ($p->kos_seunit)<span>{{ $p->kos_seunit }}</span>@endif</a>
                    @elseif ($p->kos_seunit)
                        <a class="mk" href="{{ route('program', $p) }}"><small>Kos</small><strong>{{ $p->kos_seunit }}</strong><span>Baca lagi →</span></a>
                    @else
                        <a class="mk" href="{{ route('mohon-bantuan') }}"><small>Untuk penerima</small><strong>Perlukan bantuan ini?</strong><span>Mohon bantuan →</span></a>
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
            <h2>Statistik bantuan</h2>
            <p>Bantuan yang telah disalurkan melalui kesemua program {{ $mc['nama'] }}.
                {{ $adaAngka ? 'Dikemas kini: '.$kaunter->max('updated_at')->format('d/m/Y').'.' : 'Angka rasmi sedang disemak dengan rekod bank dan akan dikemas kini.' }}</p>
        </div>
        <div class="snum">
            @foreach ($kaunter as $c)
                <div>
                    @if ($c->nilai !== null)<strong>{{ number_format($c->nilai) }}</strong>@else<strong class="tunggu">Akan dikemas kini</strong>@endif
                    <span>{{ $c->label }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 5. Kempen --}}
<section class="section alt" id="kempen">
    <div class="wrap">
        <h2>Kempen Sedang Berlangsung</h2>
        <p class="lead">Ayuh lakukan kebaikan melalui kempen-kempen yang sedang berjalan.</p>
        <div class="grid gk" style="margin-top:24px">
            @foreach ($kempens as $k) @include('components.kempen-card', ['k' => $k]) @endforeach
        </div>
    </div>
</section>

{{-- 6. Aktiviti & hebahan (laporan agihan yang diterbitkan) --}}
<section class="section">
    <div class="wrap">
        <h2>Aktiviti &amp; Hebahan</h2>
        @if ($laporan->isNotEmpty())
            @php $utama = $laporan->first(); @endphp
            <div class="berita">
                <article class="butama"><a href="{{ route('impak.bulan', $utama->bulan) }}">
                    <span class="tag">{{ $utama->program?->nama ?? 'Laporan agihan' }}</span>
                    <h3>{{ $utama->tajuk }}</h3>
                    <p class="muted">{{ $utama->tarikh_agihan?->format('d/m/Y') }} @if ($utama->lokasi) · {{ $utama->lokasi }} @endif</p>
                    <div class="thumb">@if (!empty($utama->gambar[0]))<img src="{{ asset($utama->gambar[0]) }}" alt="{{ $utama->tajuk }}" loading="lazy">@else<span>@if ($utama->penerima !== null){{ $utama->penerima }} penerima @else {{ $utama->tajuk }} @endif</span>@endif</div>
                </a></article>
                <div class="bsen">
                    @foreach ($laporan->skip(1) as $r)
                        <article><a href="{{ route('impak.bulan', $r->bulan) }}">
                            <div class="thumb">@if (!empty($r->gambar[0]))<img src="{{ asset($r->gambar[0]) }}" alt="{{ $r->tajuk }}" loading="lazy">@else<span>{{ $r->program?->nama ?? 'Agihan' }}</span>@endif</div>
                            <div><span class="tag">{{ $r->program?->nama ?? 'Laporan agihan' }}</span><h3>{{ $r->tajuk }}</h3><p class="muted" style="margin:0">{{ $r->tarikh_agihan?->format('d/m/Y') }}</p></div>
                        </a></article>
                    @endforeach
                </div>
            </div>
        @else
            <div class="kosong"><p style="margin:0">Laporan agihan bulanan akan dipaparkan di sini, lengkap dengan tarikh, bilangan penerima dan kos.</p></div>
        @endif
        <div class="ikuti">
            <a class="btn btn-line" href="{{ route('impak') }}">Lihat semua laporan</a>
            @foreach ($mc['sosial'] as $nama => $url)<a class="btn btn-line" href="{{ $url }}" rel="noopener">Ikuti kami di {{ $nama }}</a>@endforeach
        </div>
    </div>
</section>

{{-- 7. Ketelusan --}}
<section class="section alt">
    <div class="wrap">
        <h2>Bagaimana infak anda sampai</h2>
        <ol class="steps grid g4">
            <li><strong>Anda infak</strong><span>Melalui BCL, pindahan bank atau QR DuitNow.</span></li>
            <li><strong>Kami rekod</strong><span>Setiap ringgit masuk ke buku tunai pertubuhan.</span></li>
            <li><strong>Sukarelawan salurkan</strong><span>Barang dibeli, dibungkus dan dihantar ke rumah penerima.</span></li>
            <li><strong>Laporan dikongsi</strong><span>Gambar dan angka agihan di Papan Impak.</span></li>
        </ol>
    </div>
</section>

{{-- 8. Panel sukarelawan --}}
<section class="section" id="sukarelawan">
    <div class="wrap">
        <div class="skuad">
            <div class="sk-logo">
                <div class="bulat"><img src="{{ asset('img/logo.png') }}" alt="{{ $mc['nama'] }}"></div>
                <p>{{ $mc['tagline'] }}</p>
            </div>
            <div>
                <h2>Sertai Sukarelawan {{ $mc['nama'] }}</h2>
                <form method="POST" action="{{ route('sukarelawan.hantar') }}">
                    @csrf
                    <p hidden><label>Jangan isi <input name="laman_web" tabindex="-1" autocomplete="off"></label></p>
                    <div class="f2">
                        <div><label for="sk-nama">Nama</label><input id="sk-nama" name="nama" value="{{ old('nama') }}" autocomplete="name" required>@error('nama')<p class="err">{{ $message }}</p>@enderror</div>
                        <div><label for="sk-telefon">No. telefon</label><input id="sk-telefon" name="telefon" type="tel" value="{{ old('telefon') }}" autocomplete="tel" required>@error('telefon')<p class="err">{{ $message }}</p>@enderror</div>
                    </div>
                    <label for="sk-minat">Kemahiran atau bantuan yang boleh disumbang</label>
                    <textarea id="sk-minat" name="minat" rows="3">{{ old('minat') }}</textarea>
                    <label class="setuju"><input type="checkbox" name="setuju" value="1" required> <span>Saya bersetuju dihubungi mengikut <a href="{{ route('privasi') }}">Notis Privasi</a>.</span></label>
                    @error('setuju')<p class="err">{{ $message }}</p>@enderror
                    <button class="btn btn-indigo" type="submit">Daftar</button>
                </form>
            </div>
        </div>
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
    el.addEventListener('scroll', function () { var k = kini(); dots.forEach(function (d, i) { d.setAttribute('aria-current', i === k ? 'true' : 'false'); }); }, { passive: true });
    ['mouseenter', 'focusin', 'touchstart'].forEach(function (e) { hero.addEventListener(e, function () { jeda = true; }, { passive: true }); });
    ['mouseleave', 'focusout'].forEach(function (e) { hero.addEventListener(e, function () { jeda = false; }); });
    if (!tenang) setInterval(function () { if (!jeda && !document.hidden) ke(kini() + 1); }, 7000);
})();
</script>
@endif
@endsection
