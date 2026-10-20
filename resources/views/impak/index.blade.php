@extends('layouts.app', ['title' => 'Papan Impak', 'description' => 'Laporan agihan bulanan Muafakat Care: tarikh, bilangan penerima, kos dan sumber dana.'])
@section('content')
@include('components.page-head', ['eyebrow' => 'Ketelusan', 'h1' => 'Papan Impak', 'lead' => 'Setiap bulan, satu laporan: apa yang disalurkan, kepada berapa keluarga, dan berapa kosnya.'])
<section class="section"><div class="wrap">
    @if ($laporan->isNotEmpty())
        <div class="grid g3">@foreach ($laporan as $r) @include('components.impak-card', ['r' => $r]) @endforeach</div>
    @else
        <p class="lead">Laporan pertama akan diterbitkan selepas agihan bulan ini.</p>
    @endif
</div></section>
@endsection
