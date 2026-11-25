@extends('layouts.app', ['title' => $program->nama, 'description' => $program->tldr])
@if (!empty($program->faq))
@push('schema')
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => collect($program->faq)->map(fn ($f) => ['@type' => 'Question', 'name' => __($f['s']), 'acceptedAnswer' => ['@type' => 'Answer', 'text' => __($f['j'])]])->all()], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush
@endif
@section('content')
@include('components.page-head', ['eyebrow' => 'Program', 'h1' => $program->ikon.' '.__($program->nama), 'lead' => $program->tldr])
<section class="section"><div class="wrap two">
    <div class="prose">
        <h2>{{ __('Apa kami buat') }}</h2>
        <ul>@foreach ($program->apa_kami_buat ?? [] as $x)<li>{{ __($x) }}</li>@endforeach</ul>
        @if ($program->kos_seunit)<h2>{{ __('Kos') }}</h2><p><strong>{{ __($program->kos_seunit) }}</strong></p>@endif
        @if (!empty($program->isi_pek))<h3>{{ __('Isi pek') }}</h3><ul>@foreach ($program->isi_pek as $x)<li>{{ __($x) }}</li>@endforeach</ul>@endif
        @if ($laporan->isNotEmpty())
            <h2>{{ __('Agihan lepas') }}</h2>
            <div class="grid g2">@foreach ($laporan as $r) @include('components.impak-card', ['r' => $r]) @endforeach</div>
        @endif
        @if (!empty($program->faq))
            <h2>{{ __('Soalan lazim') }}</h2>
            @foreach ($program->faq as $f)<details><summary>{{ __($f['s']) }}</summary><p>{{ __($f['j']) }}</p></details>@endforeach
        @endif
    </div>
    <aside>
        @if ($kempen) @include('components.kempen-card', ['k' => $kempen])
        @else <div class="card"><h3>{{ __('Perlukan bantuan?') }}</h3><p>{{ __('Hantar permohonan dan pasukan kami akan menyemak.') }}</p><a class="btn btn-red" href="{{ lr('mohon-bantuan') }}">{{ __('Mohon Bantuan') }}</a></div>
        @endif
    </aside>
</div></section>
@endsection
