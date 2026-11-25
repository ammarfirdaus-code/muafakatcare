@extends('layouts.app', ['title' => 'Cara Infak', 'description' => 'Semua saluran infak rasmi Muafakat Care: BCL (FPX, kad, e-wallet), pindahan bank dan QR DuitNow.'])
@section('content')
@php $b = config('muafakat.bank'); @endphp
@include('components.page-head', ['eyebrow' => 'Infak', 'h1' => 'Cara Infak', 'lead' => 'Pilih saluran yang paling mudah untuk anda. Semua saluran di bawah adalah rasmi.'])
<section class="section"><div class="wrap">
    <h2>1. {{ __('Infak online (FPX, kad, e-wallet)') }}</h2>
    <div class="grid gk" style="margin:20px 0 40px">@foreach ($kempens as $k) @include('components.kempen-card', ['k' => $k]) @endforeach</div>
    <div class="grid g2">
        <div class="card"><h2>2. {{ __('Pindahan bank') }}</h2><p><strong>{{ $b['nama'] }}</strong><br><span class="acc">{{ $b['no_akaun'] }}</span><br>{{ $b['pemegang'] }}</p></div>
        <div class="card"><h2>3. {{ __('QR DuitNow') }}</h2><img src="{{ asset('img/duitnow-qr.jpg') }}" alt="QR DuitNow Muafakat Care" width="220"></div>
    </div>
    <div class="warn"><strong>⚠️ {{ __('Amaran penipuan') }}:</strong> {{ __(':nama tidak pernah meminta infak ke akaun peribadi. Akaun rasmi hanyalah atas nama :pemegang.', ['nama' => config('muafakat.nama'), 'pemegang' => $b['pemegang']]) }}</div>
</div></section>
@endsection
