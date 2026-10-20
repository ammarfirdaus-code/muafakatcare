@extends('layouts.app', ['title' => $program->nama, 'description' => $program->tldr])
@if (!empty($program->faq))
@push('schema')
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => collect($program->faq)->map(fn ($f) => ['@type' => 'Question', 'name' => $f['s'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['j']]])->all()], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush
@endif
@section('content')
@include('components.page-head', ['eyebrow' => 'Program', 'h1' => $program->ikon.' '.$program->nama, 'lead' => $program->tldr])
<section class="section"><div class="wrap two">
    <div class="prose">
        <h2>Apa kami buat</h2>
        <ul>@foreach ($program->apa_kami_buat ?? [] as $x)<li>{{ $x }}</li>@endforeach</ul>
        @if ($program->kos_seunit)<h2>Kos</h2><p><strong>{{ $program->kos_seunit }}</strong></p>@endif
        @if (!empty($program->isi_pek))<h3>Isi pek</h3><ul>@foreach ($program->isi_pek as $x)<li>{{ $x }}</li>@endforeach</ul>@endif
        @if ($laporan->isNotEmpty())
            <h2>Agihan lepas</h2>
            <div class="grid g2">@foreach ($laporan as $r) @include('components.impak-card', ['r' => $r]) @endforeach</div>
        @endif
        @if (!empty($program->faq))
            <h2>Soalan lazim</h2>
            @foreach ($program->faq as $f)<details><summary>{{ $f['s'] }}</summary><p>{{ $f['j'] }}</p></details>@endforeach
        @endif
    </div>
    <aside>
        @if ($kempen) @include('components.kempen-card', ['k' => $kempen])
        @else <div class="card"><h3>Perlukan bantuan?</h3><p>Hantar permohonan dan pasukan kami akan menyemak.</p><a class="btn btn-red" href="{{ route('mohon-bantuan') }}">Mohon Bantuan</a></div>
        @endif
    </aside>
</div></section>
@endsection
