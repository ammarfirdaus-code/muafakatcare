@extends('layouts.app', ['title' => __('Laporan Impak').' '.$bulan])
@section('content')
@include('components.page-head', ['eyebrow' => __('Laporan').' '.$bulan, 'h1' => __('Laporan Agihan').' '.\Carbon\Carbon::parse($bulan.'-01')->translatedFormat('F Y')])
<section class="section"><div class="wrap prose">
    @foreach ($laporan as $r)
        <h2>{{ __($r->tajuk) }}</h2>
        <p class="muted">{{ $r->tarikh_agihan?->format('d/m/Y') }} @if ($r->lokasi) · {{ $r->lokasi }} @endif</p>
        <table class="data">
            @if ($r->sasaran !== null)<tr><th>{{ __('Sasaran') }}</th><td>{{ $r->sasaran }}</td></tr>@endif
            @if ($r->penerima !== null)<tr><th>{{ __('Penerima') }}</th><td>{{ $r->penerima }}</td></tr>@endif
            @if ($r->kos !== null)<tr><th>{{ __('Kos') }}</th><td>RM{{ number_format($r->kos, 2) }}</td></tr>@endif
            @if ($r->sumber_dana)<tr><th>{{ __('Sumber dana') }}</th><td>{{ __($r->sumber_dana) }}</td></tr>@endif
        </table>
        @if ($r->nota)<p>{{ __($r->nota) }}</p>@endif
        <div class="grid g3">@foreach ($r->gambar ?? [] as $g)<img src="{{ asset($g) }}" alt="{{ __($r->tajuk) }}" loading="lazy" style="border-radius:12px">@endforeach</div>
    @endforeach
</div></section>
@endsection
