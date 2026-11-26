@php
    $mc = config('muafakat');
    $programFooter = \App\Models\Program::orderBy('susunan')->get(['slug', 'nama']);
@endphp
<footer class="ftr">
    <div class="wrap cols">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="{{ $mc['nama'] }}" class="flogo">
            <p><strong style="color:#fff">{{ $mc['nama_pertubuhan'] }}<br>({{ $mc['no_ppm'] }})</strong></p>
            <p class="small">{{ $mc['alamat'] ?: __('Alamat: akan dikemas kini') }}</p>
            @if ($mc['whatsapp']) <a class="baris" href="https://wa.me/{{ $mc['whatsapp'] }}" rel="noopener">@include('components.ikon', ['nama' => 'whatsapp']) +{{ $mc['whatsapp'] }}</a> @endif
            @if ($mc['emel']) <a class="baris" href="mailto:{{ $mc['emel'] }}">@include('components.ikon', ['nama' => 'emel']) {{ $mc['emel'] }}</a> @endif
            <div class="sos">
                @foreach ($mc['sosial'] as $nama => $url)<a class="{{ strtolower($nama) }}" href="{{ $url }}" rel="noopener" aria-label="{{ $nama }}" title="{{ $nama }}">@include('components.ikon', ['nama' => $nama, 'saiz' => 20])</a>@endforeach
                @if ($mc['whatsapp'])<a class="whatsapp" href="https://wa.me/{{ $mc['whatsapp'] }}" rel="noopener" aria-label="WhatsApp" title="WhatsApp">@include('components.ikon', ['nama' => 'whatsapp', 'saiz' => 20])</a>@endif
            </div>
        </div>
        <div>
            <h4>{{ __('Pautan') }}</h4>
            <a href="{{ lr('tentang') }}">{{ __('Tentang Kami') }}</a>
            <a href="{{ lr('sukarelawan') }}">{{ __('Jadi Sukarelawan') }}</a>
            <a href="{{ lr('impak') }}">{{ __('Papan Impak') }}</a>
            <a href="{{ lr('infak') }}">{{ __('Jom Infak') }}</a>
            <a href="{{ lr('mohon-bantuan') }}">{{ __('Mohon Bantuan') }}</a>
            <a href="{{ lr('hubungi') }}">{{ __('Hubungi Kami') }}</a>
        </div>
        <div>
            <h4>{{ __('Ketelusan') }}</h4>
            <a href="{{ lr('laporan') }}">{{ __('Laporan') }}</a>
            <a href="{{ lr('soalan-lazim') }}">{{ __('Soalan Lazim') }}</a>
            <a href="{{ lr('ebook') }}">{{ __('eBook Percuma') }}</a>
            <a href="{{ lr('privasi') }}">{{ __('Notis Privasi (PDPA)') }}</a>
        </div>
        <div>
            <h4>{{ __('Program Kami') }}</h4>
            @foreach ($programFooter as $p)<a href="{{ lr('program', $p) }}">{{ __($p->nama) }}</a>@endforeach
            <div class="fbank">
                <span class="small">{{ $mc['bank']['nama'] }}</span>
                <strong>{{ $mc['bank']['no_akaun'] }}</strong>
                <span class="small">{{ $mc['bank']['pemegang'] }}</span><br>
                <a class="btn btn-red" href="{{ lr('infak') }}">{{ __('Cara Infak') }}</a>
            </div>
        </div>
    </div>
    <div class="wrap base">
        <span>{{ $mc['nama_pertubuhan'] }} ({{ $mc['no_ppm'] }}) © {{ date('Y') }}</span>
        <span>{{ $mc['tagline'] }}</span>
    </div>
</footer>
