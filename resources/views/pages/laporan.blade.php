@extends('layouts.app', ['title' => 'Laporan', 'description' => 'Laporan tahunan dan ringkasan kewangan Muafakat Care.'])
@section('content')
@include('components.page-head', ['eyebrow' => 'Laporan', 'h1' => 'Laporan & Kewangan', 'lead' => 'Ringkasan tahunan kutipan dan agihan, serta penyata yang dihantar kepada ROS.'])
<section class="section"><div class="wrap prose">
    <p>Laporan bulanan: lihat <a href="{{ route('impak') }}">Papan Impak</a>.</p>
    <p class="todo">GANTI: ringkasan tahunan + PDF penyata ROS selepas lulus Ammar</p>
</div></section>
@endsection
