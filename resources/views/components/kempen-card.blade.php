<article class="card kc">
    <div class="thumb">@if ($k->gambar)<img src="{{ asset($k->gambar) }}" alt="{{ __($k->tajuk) }}" loading="lazy">@else<span>{{ __($k->tajuk) }}</span>@endif</div>
    @if ($k->label)<span class="pill">{{ __($k->label) }}</span>@endif
    <h3>{{ __($k->tajuk) }}</h3>
    <p>{{ __($k->ringkas) }}</p>
    @if ($k->sasaran)
        <div class="progress"><span style="width: {{ $k->peratus() ?? 0 }}%"></span></div>
        <p class="muted">
            @if ($k->terkumpul !== null)
                {{ __(':a daripada :b', ['a' => $k->format($k->terkumpul), 'b' => $k->format($k->sasaran)]) }} · {{ $k->peratus() }}%
            @else
                {{ __('Sasaran :b · kemajuan dikemas kini setiap hari', ['b' => $k->format($k->sasaran)]) }}
            @endif
        </p>
    @endif
    @if ($k->pautan_bcl)
        <a class="btn btn-red" href="{{ $k->urlBenam() ? route('infak.kempen', $k->slug) : $k->pautan_bcl }}" rel="noopener">{{ __('Infak Sekarang') }}</a>
    @else
        <span class="todo">{{ __('Pautan infak belum disahkan') }}</span>
    @endif
</article>
