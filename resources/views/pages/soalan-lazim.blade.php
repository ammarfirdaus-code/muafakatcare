@extends('layouts.app', ['title' => 'Soalan Lazim', 'description' => 'Jawapan ringkas tentang Muafakat Care: pendaftaran, kawasan, kos foodbank, cara infak dan cara mohon bantuan.'])
@push('schema')
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $soalan->map(fn ($f) => ['@type' => 'Question', 'name' => $f->soalan, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f->jawapan]])->all()], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush
@section('content')
@include('components.page-head', ['eyebrow' => 'FAQ', 'h1' => 'Soalan Lazim'])
<section class="section"><div class="wrap prose">
    @foreach ($soalan as $f)<details open><summary>{{ $f->soalan }}</summary><p>{{ $f->jawapan }}</p></details>@endforeach
</div></section>
@endsection
