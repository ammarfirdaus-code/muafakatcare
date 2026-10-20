@extends('layouts.app', ['title' => 'Tentang Kami'])
@section('content')
@php $mc = config('muafakat'); @endphp
@include('components.page-head', ['eyebrow' => 'Tentang Kami', 'h1' => $mc['tagline'], 'lead' => $mc['pengenalan']])
<section class="section"><div class="wrap grid g2">
    <div class="prose">
        <h2>Kisah kami</h2><p class="todo">GANTI: kisah penubuhan (tahun, siapa, kenapa)</p>
        <h2>Kawasan operasi</h2><p>{{ $mc['kawasan'] }}</p>
        <h2>Pasukan</h2><p class="todo">GANTI: AJK/pasukan yang setuju dipaparkan</p>
    </div>
    <div class="card">
        <h3>Maklumat rasmi</h3>
        <p><strong>Nama pertubuhan:</strong> {{ $mc['nama_pertubuhan'] }}<br><strong>No. pendaftaran:</strong> {{ $mc['no_ppm'] }}<br><strong>Nama program:</strong> {{ $mc['nama'] }}</p>
        <p><strong>Alamat:</strong> {{ $mc['alamat'] ?: 'Akan dikemas kini' }}</p>
    </div>
</div></section>
@endsection
