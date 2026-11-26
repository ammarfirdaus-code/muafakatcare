@extends('layouts.app', ['title' => 'eBook Percuma', 'description' => 'Muat turun eBook percuma daripada Muafakat Care: hadis dan ayat tentang sedekah, doa, wakaf, panduan penjaga pesakit dan banyak lagi.'])
@section('content')
@include('components.page-head', ['eyebrow' => 'Percuma', 'h1' => 'eBook Percuma', 'lead' => 'Hadiah kami untuk para penyumbang dan orang ramai. Muat turun terus, tanpa perlu mendaftar.'])
<section class="section"><div class="wrap">
    @if (app()->getLocale() === 'en')<p class="muted" style="margin-bottom:24px">{{ __('eBook ditulis dalam Bahasa Melayu.') }}</p>@endif
    <div class="grid ebuku">
        @foreach (config('ebook') as $e)
            <article class="eb">
                <a class="eb-kulit" href="{{ asset('ebook/'.$e['slug'].'.pdf') }}" download><img src="{{ asset('img/ebook/'.$e['slug'].'.jpg') }}" alt="{{ $e['tajuk'] }}" loading="lazy" width="520" height="738"></a>
                <h3>{{ $e['tajuk'] }}</h3>
                <p>{{ $e['sub'] }}</p>
                <p class="eb-harga"><b>{{ __('PERCUMA') }}</b> · PDF · {{ $e['hal'] }} {{ __('halaman') }}</p>
                <a class="btn btn-red" href="{{ asset('ebook/'.$e['slug'].'.pdf') }}" download>{{ __('Muat Turun eBook') }}</a>
            </article>
        @endforeach
    </div>
    <div class="warn" style="margin-top:40px">{{ __('Teks Al-Quran dan hadis dalam eBook ini diambil daripada sumber yang dinyatakan pada setiap halaman. Jika anda menemui kesilapan, maklumkan kepada kami supaya dapat dibetulkan.') }}</div>
</div></section>
@endsection
