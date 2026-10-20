<article class="card kc">
    <div class="thumb">@if ($k->gambar)<img src="{{ asset($k->gambar) }}" alt="{{ $k->tajuk }}" loading="lazy">@else<span>{{ $k->tajuk }}</span>@endif</div>
    @if ($k->label)<span class="pill">{{ $k->label }}</span>@endif
    <h3>{{ $k->tajuk }}</h3>
    <p>{{ $k->ringkas }}</p>
    @if ($k->sasaran)
        <div class="progress"><span style="width: {{ $k->peratus() ?? 0 }}%"></span></div>
        <p class="muted">
            @if ($k->terkumpul !== null)
                {{ $k->format($k->terkumpul) }} daripada {{ $k->format($k->sasaran) }} · {{ $k->peratus() }}%
            @else
                Sasaran {{ $k->format($k->sasaran) }} · kemajuan dikemas kini setiap hari
            @endif
        </p>
    @endif
    @if ($k->pautan_bcl)
        <a class="btn btn-red" href="{{ $k->pautan_bcl }}" rel="noopener">Infak Sekarang</a>
    @else
        <span class="todo">Pautan infak belum disahkan</span>
    @endif
</article>
