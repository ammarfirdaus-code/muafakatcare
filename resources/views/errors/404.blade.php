@extends('layouts.app', ['title' => 'Tidak dijumpai'])
@section('content')
<section class="section"><div class="wrap prose"><h1>{{ __('Halaman tidak dijumpai') }}</h1><a class="btn btn-red" href="{{ lr('utama') }}">{{ __('Ke laman utama') }}</a></div></section>
@endsection
