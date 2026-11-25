<article class="card kc">
    @if (!empty($r->gambar[0]))<div class="thumb"><img src="{{ asset($r->gambar[0]) }}" alt="{{ __($r->tajuk) }}" loading="lazy"></div>@endif
    <p class="muted">{{ $r->tarikh_agihan?->format('d/m/Y') ?? \Carbon\Carbon::parse($r->bulan.'-01')->translatedFormat('F Y') }} @if ($r->lokasi) · {{ $r->lokasi }} @endif</p>
    <h3>{{ __($r->tajuk) }}</h3>
    <ul class="nums">
        @if ($r->penerima !== null)<li><strong>{{ $r->penerima }}</strong> {{ __('penerima') }}</li>@endif
        @if ($r->kos !== null)<li><strong>RM{{ number_format($r->kos) }}</strong> {{ __('disalurkan') }}</li>@endif
        @if ($r->sumber_dana)<li>{{ __($r->sumber_dana) }}</li>@endif
    </ul>
    <a href="{{ lr('impak.bulan', $r->bulan) }}">{{ __('Baca laporan penuh') }} →</a>
</article>
