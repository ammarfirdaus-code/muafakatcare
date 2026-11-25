@php
    $mc = config('muafakat');
    $programFooter = \App\Models\Program::orderBy('susunan')->get(['slug', 'nama']);
@endphp
<footer class="ftr">
    <div class="wrap cols">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="{{ $mc['nama'] }}" class="flogo">
            <p><strong style="color:#fff">{{ $mc['nama_pertubuhan'] }}<br>({{ $mc['no_ppm'] }})</strong></p>
            <p class="small">{{ $mc['alamat'] ?: 'Alamat: akan dikemas kini' }}</p>
            @if ($mc['whatsapp']) <a href="https://wa.me/{{ $mc['whatsapp'] }}" rel="noopener">WhatsApp: +{{ $mc['whatsapp'] }}</a> @endif
            @if ($mc['emel']) <a href="mailto:{{ $mc['emel'] }}">{{ $mc['emel'] }}</a> @endif
            @if ($mc['sosial'])
                <div class="sos">@foreach ($mc['sosial'] as $nama => $url)<a href="{{ $url }}" rel="noopener">{{ $nama }}</a>@endforeach</div>
            @endif
        </div>
        <div>
            <h4>Pautan</h4>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
            <a href="{{ route('sukarelawan') }}">Sertai Kami</a>
            <a href="{{ route('impak') }}">Papan Impak</a>
            <a href="{{ route('infak') }}">Jom Infak</a>
            <a href="{{ route('mohon-bantuan') }}">Mohon Bantuan</a>
            <a href="{{ route('hubungi') }}">Hubungi Kami</a>
        </div>
        <div>
            <h4>Ketelusan</h4>
            <a href="{{ route('laporan') }}">Laporan</a>
            <a href="{{ route('soalan-lazim') }}">Soalan Lazim</a>
            <a href="{{ route('privasi') }}">Notis Privasi (PDPA)</a>
        </div>
        <div>
            <h4>Program Kami</h4>
            @foreach ($programFooter as $p)<a href="{{ route('program', $p) }}">{{ $p->nama }}</a>@endforeach
            <div class="fbank">
                <span class="small">{{ $mc['bank']['nama'] }}</span>
                <strong>{{ $mc['bank']['no_akaun'] }}</strong>
                <span class="small">{{ $mc['bank']['pemegang'] }}</span><br>
                <a class="btn btn-red" href="{{ route('infak') }}">Cara Infak</a>
            </div>
        </div>
    </div>
    <div class="wrap base">
        <span>{{ $mc['nama_pertubuhan'] }} ({{ $mc['no_ppm'] }}) © {{ date('Y') }}</span>
        <span>{{ $mc['tagline'] }}</span>
    </div>
</footer>
