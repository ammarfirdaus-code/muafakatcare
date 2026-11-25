@extends('layouts.app', ['title' => 'Terima kasih'])
@section('content')
<section class="section"><div class="wrap prose"><h1>{{ __('Terima kasih') }}</h1><p class="lead">{{ __('Maklumat anda telah diterima. Pasukan kami akan menghubungi anda.') }}</p><a class="btn btn-red" href="{{ lr('utama') }}">{{ __('Kembali ke laman utama') }}</a></div></section>
@endsection
