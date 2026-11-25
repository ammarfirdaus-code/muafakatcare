@extends('layouts.app', ['title' => 'Mohon Bantuan', 'description' => 'Borang permohonan bantuan Muafakat Care untuk keluarga di Bakri dan Muar.'])
@section('content')
@include('components.page-head', ['eyebrow' => 'Bantuan', 'h1' => 'Mohon Bantuan', 'lead' => 'Isi maklumat ringkas. Pasukan kami akan menyemak dan menghubungi anda.'])
<section class="section"><div class="wrap prose">
<form method="POST" action="{{ lr('mohon-bantuan.hantar') }}">
    @csrf
    <p hidden><label>{{ __('Jangan isi') }} <input name="laman_web" tabindex="-1" autocomplete="off"></label></p>
    <label for="nama">{{ __('Nama') }}</label><input id="nama" name="nama" value="{{ old('nama') }}" required>@error('nama')<p class="err">{{ $message }}</p>@enderror
    <label for="telefon">{{ __('No. telefon') }}</label><input id="telefon" name="telefon" type="tel" value="{{ old('telefon') }}" required>@error('telefon')<p class="err">{{ $message }}</p>@enderror
    <label for="kawasan">{{ __('Kawasan (mukim/taman)') }}</label><input id="kawasan" name="kawasan" value="{{ old('kawasan') }}" required>@error('kawasan')<p class="err">{{ $message }}</p>@enderror
    <label for="jenis">{{ __('Jenis bantuan') }}</label>
    <select id="jenis" name="jenis">@foreach (['Foodbank', 'Pinjam katil hospital', 'Bantuan kecemasan', 'Lain-lain'] as $j)<option value="{{ $j }}" @selected(old('jenis') === $j)>{{ __($j) }}</option>@endforeach</select>
    <label for="tanggungan">{{ __('Bilangan tanggungan') }}</label><input id="tanggungan" name="tanggungan" type="number" min="0" value="{{ old('tanggungan') }}">
    <label for="keterangan">{{ __('Ceritakan keperluan anda') }}</label><textarea id="keterangan" name="keterangan" rows="5">{{ old('keterangan') }}</textarea>
    <p class="muted" style="margin-top:16px"><input type="checkbox" name="setuju" value="1" required style="width:auto"> {{ __('Saya bersetuju maklumat ini digunakan untuk menyemak permohonan, mengikut') }} <a href="{{ lr('privasi') }}">{{ __('Notis Privasi') }}</a>.</p>
    @error('setuju')<p class="err">{{ $message }}</p>@enderror
    <button class="btn btn-red" type="submit">{{ __('Hantar permohonan') }}</button>
</form>
</div></section>
@endsection
