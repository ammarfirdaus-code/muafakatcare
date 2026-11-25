@extends('layouts.app', ['title' => 'Notis Privasi'])
@section('content')
@include('components.page-head', ['h1' => 'Notis Privasi'])
<section class="section"><div class="wrap prose">
    <p class="todo">{{ __('DRAF: teks perlu disemak Ammar sebelum terbit.') }}</p>
    <p>{{ __(':org mengumpul nama, nombor telefon dan maklumat keperluan yang anda berikan melalui borang di laman ini semata-mata untuk menyemak permohonan bantuan, menyusun sukarelawan dan menghubungi anda berkaitan perkara tersebut.', ['org' => config('muafakat.nama_pertubuhan')]) }}</p>
    <p>{{ __('Kami tidak menjual atau berkongsi maklumat anda dengan pihak ketiga untuk tujuan pemasaran. Anda boleh meminta maklumat anda dikemas kini atau dipadam dengan menghubungi kami.') }}</p>
    <p>{{ __('Kami tidak memaparkan nama penuh, alamat atau gambar penerima bantuan tanpa kebenaran.') }}</p>
</div></section>
@endsection
