@extends('layouts.app', ['title' => 'Laporan Impak '.$bulan])
@section('content')
@include('components.page-head', ['eyebrow' => 'Laporan '.$bulan, 'h1' => 'Laporan Agihan '.\Carbon\Carbon::parse($bulan.'-01')->translatedFormat('F Y')])
<section class="section"><div class="wrap prose">
    @foreach ($laporan as $r)
        <h2>{{ $r->tajuk }}</h2>
        <p class="muted">{{ $r->tarikh_agihan?->format('d/m/Y') }} @if ($r->lokasi) · {{ $r->lokasi }} @endif</p>
        <table class="data">
            @if ($r->sasaran !== null)<tr><th>Sasaran</th><td>{{ $r->sasaran }}</td></tr>@endif
            @if ($r->penerima !== null)<tr><th>Penerima</th><td>{{ $r->penerima }}</td></tr>@endif
            @if ($r->kos !== null)<tr><th>Kos</th><td>RM{{ number_format($r->kos, 2) }}</td></tr>@endif
            @if ($r->sumber_dana)<tr><th>Sumber dana</th><td>{{ $r->sumber_dana }}</td></tr>@endif
        </table>
        @if ($r->nota)<p>{{ $r->nota }}</p>@endif
        <div class="grid g3">@foreach ($r->gambar ?? [] as $g)<img src="{{ asset($g) }}" alt="Agihan {{ $r->tajuk }}" loading="lazy" style="border-radius:12px">@endforeach</div>
    @endforeach
</div></section>
@endsection
