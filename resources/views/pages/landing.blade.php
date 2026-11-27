@php $mc = config('muafakat'); @endphp
<!doctype html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kempen->tajuk }} | {{ $mc['nama'] }}</title>
    <meta name="description" content="{{ $kempen->ringkas }}">
    <link rel="canonical" href="{{ route('infak.kempen', $kempen->slug) }}">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <meta property="og:title" content="{{ $kempen->tajuk }} | {{ $mc['nama'] }}">
    <meta property="og:description" content="{{ $kempen->ringkas }}">
    <meta property="og:image" content="{{ asset($kempen->gambar ?: 'img/logo.png') }}">
    <meta name="theme-color" content="#1E1A68">
    <style>html{-webkit-text-size-adjust:100%}body{margin:0;font-family:Poppins,Inter,system-ui,-apple-system,"Segoe UI",sans-serif;line-height:1.5;color:#2B2E3A;background:#fff}img{max-width:100%}</style>
</head>
<body>
{!! $landing !!}
</body>
</html>
