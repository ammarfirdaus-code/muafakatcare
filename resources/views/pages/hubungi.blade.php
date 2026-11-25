@extends('layouts.app', ['title' => 'Hubungi Kami'])
@section('content')
@php $mc = config('muafakat'); @endphp
@include('components.page-head', ['eyebrow' => 'Hubungi', 'h1' => 'Hubungi Kami'])
<section class="section"><div class="wrap grid g3">
    <div class="card"><h3>@include('components.ikon', ['nama' => 'whatsapp']) WhatsApp</h3>@if ($mc['whatsapp'])<a class="btn btn-red" href="https://wa.me/{{ $mc['whatsapp'] }}">{{ __('Mesej kami') }}</a>@else<p class="muted">{{ __('Akan dikemas kini') }}</p>@endif</div>
    <div class="card"><h3>@include('components.ikon', ['nama' => 'emel']) {{ __('Emel') }}</h3>@if ($mc['emel'])<a href="mailto:{{ $mc['emel'] }}">{{ $mc['emel'] }}</a>@else<p class="muted">{{ __('Akan dikemas kini') }}</p>@endif</div>
    <div class="card"><h3>{{ __('Alamat') }}</h3>@if ($mc['alamat'])<p>{{ $mc['alamat'] }}</p>@else<p class="muted">{{ __('Akan dikemas kini') }}</p>@endif</div>
</div></section>
@if ($mc['sosial'])
<section class="section alt"><div class="wrap">
    <h2>{{ __('Media sosial') }}</h2>
    <div class="ikuti">@foreach ($mc['sosial'] as $nama => $url)<a class="btn btn-line" href="{{ $url }}" rel="noopener">@include('components.ikon', ['nama' => $nama]){{ $nama }}</a>@endforeach</div>
</div></section>
@endif
@endsection
