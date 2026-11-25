@extends('layouts.app', ['title' => 'Tentang Kami'])
@section('content')
@php $mc = config('muafakat'); @endphp
@include('components.page-head', ['eyebrow' => 'Tentang Kami', 'h1' => $mc['tagline'], 'lead' => $mc['pengenalan']])
<section class="section"><div class="wrap grid g2">
    <div class="prose">
        <h2>{{ __('Kisah kami') }}</h2>
        <p><strong>{{ __('Muafakat Care sejak 2020.') }}</strong> {{ __('Kami bermula ketika pandemik COVID-19 melanda Malaysia. Ramai keluarga kehilangan pekerjaan, dan kami mengambil inisiatif untuk membantu mereka.') }}</p>
        <p>{{ __('Muafakat Care ialah pertubuhan bukan kerajaan (NGO) yang memberi tumpuan kepada aktiviti kemanusiaan, bantuan sosial dan pemerkasaan komuniti, demi kesejahteraan mereka yang memerlukan.') }}</p>
        <h2>{{ __('Misi') }}</h2>
        @foreach ($mc['misi'] as $m)<p>{{ __($m) }}</p>@endforeach
        <h2>{{ __('Kawasan operasi') }}</h2><p>{{ __($mc['kawasan']) }}</p>
    </div>
    <div class="card">
        <h3>{{ __('Maklumat rasmi') }}</h3>
        <p><strong>{{ __('Nama pertubuhan') }}:</strong> {{ $mc['nama_pertubuhan'] }}<br><strong>{{ __('No. pendaftaran') }}:</strong> {{ $mc['no_ppm'] }}<br><strong>{{ __('Nama program') }}:</strong> {{ $mc['nama'] }}</p>
        <p>{{ __('Pertubuhan sah yang berdaftar dengan Jabatan Pendaftaran Pertubuhan Malaysia (ROS).') }}</p>
        <p><strong>{{ __('Alamat') }}:</strong> {{ $mc['alamat'] ?: __('Akan dikemas kini') }}</p>
    </div>
</div></section>
<section class="section alt"><div class="wrap">
    <h2>{{ __('Pasukan kami') }}</h2>
    <div class="grid g4 pasukan" style="margin-top:24px">
        @foreach ($mc['pasukan'] as $nama => $jawatan)
            <div class="card"><h3>{{ $nama }}</h3><p class="muted" style="margin:0">{{ __($jawatan) }}</p></div>
        @endforeach
    </div>
</div></section>
@endsection
