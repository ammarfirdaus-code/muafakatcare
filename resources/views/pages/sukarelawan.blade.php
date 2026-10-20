@extends('layouts.app', ['title' => 'Jadi Sukarelawan', 'description' => 'Sertai pasukan sukarelawan Muafakat Care untuk agihan foodbank dan program kebajikan di Bakri dan Muar.'])
@section('content')
@include('components.page-head', ['eyebrow' => 'Sukarelawan', 'h1' => 'Jadi Sukarelawan', 'lead' => 'Bungkus, hantar, ziarah. Sedikit masa anda, besar maknanya untuk mereka.'])
<section class="section"><div class="wrap prose">
<form method="POST" action="{{ route('sukarelawan.hantar') }}">
    @csrf
    <p hidden><label>Jangan isi <input name="laman_web" tabindex="-1" autocomplete="off"></label></p>
    <label for="nama">Nama</label><input id="nama" name="nama" value="{{ old('nama') }}" required>@error('nama')<p class="err">{{ $message }}</p>@enderror
    <label for="telefon">No. telefon</label><input id="telefon" name="telefon" type="tel" value="{{ old('telefon') }}" required>@error('telefon')<p class="err">{{ $message }}</p>@enderror
    <label for="minat">Boleh bantu apa?</label><textarea id="minat" name="minat" rows="4">{{ old('minat') }}</textarea>
    <p class="muted" style="margin-top:16px"><input type="checkbox" name="setuju" value="1" required style="width:auto"> Saya bersetuju dihubungi mengikut <a href="{{ route('privasi') }}">Notis Privasi</a>.</p>
    <button class="btn btn-red" type="submit">Daftar</button>
</form>
</div></section>
@endsection
