@php $mc = config('muafakat'); @endphp
<footer class="ftr">
    <div class="wrap cols">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="{{ $mc['nama'] }}" class="flogo">
            <p>{{ $mc['nama'] }} ialah program <strong>{{ $mc['nama_pertubuhan'] }}</strong> ({{ $mc['no_ppm'] }}).</p>
            <p class="small">{{ $mc['alamat'] ?: 'Alamat: akan dikemas kini' }}</p>
        </div>
        <div>
            <h4>Pautan</h4>
            <a href="{{ route('program', 'foodbank') }}">Program</a><a href="{{ route('impak') }}">Papan Impak</a><a href="{{ route('laporan') }}">Laporan</a><a href="{{ route('mohon-bantuan') }}">Mohon Bantuan</a><a href="{{ route('sukarelawan') }}">Jadi Sukarelawan</a>
        </div>
        <div>
            <h4>Hubungi</h4>
            @if ($mc['whatsapp']) <a href="https://wa.me/{{ $mc['whatsapp'] }}">WhatsApp</a> @endif
            @if ($mc['emel']) <a href="mailto:{{ $mc['emel'] }}">{{ $mc['emel'] }}</a> @endif
            @foreach ($mc['sosial'] as $nama => $url) <a href="{{ $url }}" rel="noopener">{{ $nama }}</a> @endforeach
            <a href="{{ route('hubungi') }}">Semua saluran</a>
        </div>
    </div>
    <div class="wrap base">
        <span>© {{ date('Y') }} {{ $mc['nama_pertubuhan'] }}</span>
        <a href="{{ route('privasi') }}">Notis Privasi (PDPA)</a>
    </div>
</footer>
