@extends('layouts.app', ['title' => 'Hubungi'])
@section('content')
@php $mc = config('muafakat'); @endphp
@include('components.page-head', ['eyebrow' => 'Hubungi', 'h1' => 'Hubungi Kami'])
<section class="section"><div class="wrap grid g3">
    <div class="card"><h3>WhatsApp</h3>@if ($mc['whatsapp'])<a class="btn btn-red" href="https://wa.me/{{ $mc['whatsapp'] }}">Mesej kami</a>@else<p class="todo">GANTI: MC_WHATSAPP dalam .env</p>@endif</div>
    <div class="card"><h3>Emel</h3>@if ($mc['emel'])<a href="mailto:{{ $mc['emel'] }}">{{ $mc['emel'] }}</a>@else<p class="todo">GANTI: MC_EMEL dalam .env</p>@endif</div>
    <div class="card"><h3>Alamat</h3>@if ($mc['alamat'])<p>{{ $mc['alamat'] }}</p>@else<p class="todo">GANTI: MC_ALAMAT dalam .env</p>@endif</div>
</div></section>
@endsection
