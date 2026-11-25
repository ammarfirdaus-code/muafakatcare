@extends('layouts.app', ['title' => 'Laporan', 'description' => 'Laporan tahunan dan ringkasan kewangan Muafakat Care.'])
@section('content')
@include('components.page-head', ['eyebrow' => 'Laporan', 'h1' => 'Laporan & Kewangan', 'lead' => 'Ringkasan tahunan kutipan dan agihan, serta penyata yang dihantar kepada ROS.'])
<section class="section"><div class="wrap prose">
    <p>{{ __('Laporan bulanan: lihat') }} <a href="{{ lr('impak') }}">{{ __('Papan Impak') }}</a>.</p>
    <p>{{ __('Ringkasan tahunan dan penyata akan dikemas kini di sini.') }}</p>
</div></section>
@endsection
