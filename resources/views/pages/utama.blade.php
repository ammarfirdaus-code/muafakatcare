@extends('layouts.app')
@section('content')
@php $utama = $kempens->first(); @endphp
<section class="hero">
    <div class="wrap hgrid">
        <div>
            <span class="eyebrow">{{ $utama?->label ?? 'Kempen bulan ini' }}</span>
            <h1>Bantu isi dapur keluarga di Bakri &amp; Muar</h1>
            <p class="lead">{{ $utama?->ringkas }}</p>
            <div class="cta">
                <a class="btn btn-red" href="{{ $utama?->pautan_bcl ?? config('muafakat.pautan_infak_utama') }}" rel="noopener">Infak Sekarang</a>
                <a class="btn btn-line" href="{{ route('impak') }}">Lihat laporan agihan</a>
            </div>
            <p class="muted">Pertubuhan berdaftar {{ config('muafakat.no_ppm') }} · Setiap agihan direkod dan dikongsi</p>
        </div>
        @if ($utama)
        <div class="hcard card">
            <h3>{{ $utama->tajuk }}</h3>
            <div class="progress"><span style="width: {{ $utama->peratus() ?? 0 }}%"></span></div>
            <p class="muted">
                @if ($utama->terkumpul !== null) {{ $utama->format($utama->terkumpul) }} / {{ $utama->format($utama->sasaran) }}
                @else Sasaran {{ $utama->sasaran ? $utama->format($utama->sasaran) : '-' }} · kemajuan akan dipaparkan @endif
            </p>
            <p><strong>RM60</strong> = 1 pek makanan untuk 1 keluarga</p>
        </div>
        @endif
    </div>
</section>

<section class="section">
    <div class="wrap grid g4">
        @foreach ($kaunter as $c)
            <div class="ctr"><strong>{{ $c->nilai !== null ? number_format($c->nilai) : '—' }}</strong><span>{{ $c->label }}</span></div>
        @endforeach
    </div>
    <p class="wrap muted center">{{ $kaunter->whereNotNull('nilai')->isNotEmpty() ? 'Dikemas kini: '.$kaunter->max('updated_at')->format('d/m/Y') : 'Angka rasmi akan dikemas kini.' }}</p>
</section>

<section class="section alt">
    <div class="wrap">
        <span class="eyebrow">Kempen aktif</span>
        <h2>Pilih di mana infak anda bermula</h2>
        <div class="grid g4" style="margin-top:24px">
            @foreach ($kempens as $k) @include('components.kempen-card', ['k' => $k]) @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <span class="eyebrow">Program kami</span>
        <h2>Empat cara kami membantu</h2>
        <div class="grid g4" style="margin-top:24px">
            @foreach ($programs as $p)
                <a class="card prog" href="{{ route('program', $p) }}"><span class="ic">{{ $p->ikon }}</span><h3>{{ $p->nama }}</h3><p>{{ $p->satu_baris }}</p></a>
            @endforeach
        </div>
    </div>
</section>

<section class="section alt">
    <div class="wrap">
        <span class="eyebrow">Papan Impak</span>
        <h2>Infak anda, bukti kami</h2>
        @if ($laporan->isNotEmpty())
            <div class="grid g3" style="margin-top:24px">@foreach ($laporan as $r) @include('components.impak-card', ['r' => $r]) @endforeach</div>
        @else
            <p class="lead">Laporan agihan bulanan akan dipaparkan di sini, lengkap dengan tarikh, bilangan penerima dan kos.</p>
        @endif
        <p style="margin-top:20px"><a class="btn btn-line" href="{{ route('impak') }}">Lihat semua laporan</a></p>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <span class="eyebrow">Ketelusan</span>
        <h2>Bagaimana infak anda sampai</h2>
        <ol class="steps grid g4">
            <li><strong>Anda infak</strong><span>Melalui BCL, pindahan bank atau QR DuitNow.</span></li>
            <li><strong>Kami rekod</strong><span>Setiap ringgit masuk ke buku tunai pertubuhan.</span></li>
            <li><strong>Sukarelawan salurkan</strong><span>Barang dibeli, dibungkus dan dihantar ke rumah penerima.</span></li>
            <li><strong>Laporan dikongsi</strong><span>Gambar dan angka agihan di Papan Impak.</span></li>
        </ol>
    </div>
</section>

<section class="band">
    <div class="wrap bandin">
        <div><h2>Jadi sebahagian daripada muafakat ini</h2><p>Infak sekali, infak setiap bulan, atau turun padang bersama kami.</p></div>
        <div class="cta"><a class="btn btn-white" href="{{ route('infak') }}">Cara Infak</a><a class="btn btn-line wl" href="{{ route('sukarelawan') }}">Jadi Sukarelawan</a></div>
    </div>
</section>
@endsection
