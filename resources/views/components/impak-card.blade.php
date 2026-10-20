<article class="card">
    <p class="muted">{{ $r->tarikh_agihan?->format('d/m/Y') }} @if ($r->lokasi) · {{ $r->lokasi }} @endif</p>
    <h3>{{ $r->tajuk }}</h3>
    <ul class="nums">
        @if ($r->penerima !== null)<li><strong>{{ $r->penerima }}</strong> penerima</li>@endif
        @if ($r->kos !== null)<li><strong>RM{{ number_format($r->kos) }}</strong> kos</li>@endif
        @if ($r->sumber_dana)<li>{{ $r->sumber_dana }}</li>@endif
    </ul>
    <a href="{{ route('impak.bulan', $r->bulan) }}">Baca laporan penuh →</a>
</article>
