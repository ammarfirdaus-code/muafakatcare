@extends('layouts.app', ['title' => $kempen->tajuk, 'description' => $kempen->ringkas])
@section('content')
@php $b = config('muafakat.bank'); @endphp
@include('components.page-head', ['eyebrow' => 'Infak', 'h1' => $kempen->tajuk, 'lead' => $kempen->ringkas])
<section class="section"><div class="wrap ik">
    <div class="ik-info">
        @if ($kempen->gambar)<img src="{{ asset($kempen->gambar) }}" alt="{{ __($kempen->tajuk) }}">@endif
        <ul class="ticks" style="border-top:0;margin-top:0;padding-top:0">
            <li>{{ __('Pertubuhan berdaftar') }} {{ config('muafakat.no_ppm') }}</li>
            <li>{{ __('Infak melalui saluran rasmi pertubuhan sahaja') }}</li>
            <li>{{ __('Setiap agihan direkod di Papan Impak') }}</li>
        </ul>
        @if ($kempen->program)<p style="margin-top:16px"><a href="{{ lr('program', $kempen->program) }}">{{ __('Ketahui tentang program ini') }} →</a></p>@endif
        <div class="card" style="margin-top:20px">
            <h3>{{ __('Cara lain untuk infak') }}</h3>
            <p style="margin:0"><strong>{{ $b['nama'] }}</strong><br><span class="acc">{{ $b['no_akaun'] }}</span><br>{{ $b['pemegang'] }}</p>
        </div>
        <p style="margin-top:16px"><a href="{{ lr('infak') }}">{{ __('Lihat semua kempen') }} →</a></p>
    </div>
    <div class="ik-borang">
        <h2>{{ __('Borang infak') }}</h2>
        <div id="bcl-payment-form" data-url="{{ $kempen->urlBenam() }}"><p class="ik-muat">{{ __('Memuatkan borang infak…') }}</p></div>
        <p class="muted" style="margin:14px 0 6px">{{ __('Bayaran diproses dengan selamat oleh BCL (Bayarcash). Anda akan dibawa ke halaman bank untuk mengesahkan bayaran.') }}</p>
        <p class="muted" style="margin:0">{{ __('Borang tidak keluar?') }} <a href="{{ $kempen->pautan_bcl }}" rel="noopener" target="_blank">{{ __('Buka borang di tab baharu') }}</a></p>
    </div>
</div></section>
<script>
(function () {
    var kotak = document.getElementById('bcl-payment-form'), muat = kotak.querySelector('.ik-muat');
    new MutationObserver(function (m, o) { if (kotak.querySelector('iframe')) { if (muat) muat.remove(); o.disconnect(); } }).observe(kotak, { childList: true });
})();
</script>
<script src="https://bcl.my/js/bc-encrypted-payment-embed.js" async></script>
@endsection
