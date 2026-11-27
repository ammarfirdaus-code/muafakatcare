<?php

namespace App\Http\Controllers;

use App\Models\KaunterImpak;
use App\Models\Kempen;
use App\Models\LaporanImpak;
use App\Models\Program;
use App\Models\SoalanLazim;
use App\Support\LandingBcl;
use Illuminate\Http\Response;

class HalamanController extends Controller
{
    public function utama()
    {
        return view('pages.utama', [
            'kempens' => Kempen::aktif()->with('program')->get(),
            'programs' => Program::orderBy('susunan')->get(),
            'kaunter' => KaunterImpak::orderBy('susunan')->get(),
            'laporan' => LaporanImpak::terbit()->with('program')->take(7)->get(),
        ]);
    }

    public function program(Program $program)
    {
        return view('program.show', [
            'program' => $program,
            'kempen' => $program->kempens()->where('aktif', true)->orderBy('susunan')->first(),
            'laporan' => $program->laporan()->terbit()->take(3)->get(),
        ]);
    }

    public function impak()
    {
        return view('impak.index', ['laporan' => LaporanImpak::terbit()->get()]);
    }

    public function impakBulan(string $bulan)
    {
        $laporan = LaporanImpak::terbit()->where('bulan', $bulan)->get();
        abort_if($laporan->isEmpty(), 404);

        return view('impak.show', ['bulan' => $bulan, 'laporan' => $laporan]);
    }

    public function infak()
    {
        return view('pages.infak', ['kempens' => Kempen::aktif()->get()]);
    }

    public function infakKempen(string $slug)
    {
        $kempen = Kempen::aktif()->with('program')->where('slug', $slug)->firstOrFail();
        abort_if($kempen->urlBenam() === null, 404);

        // Landing page yang sama seperti di BCL, dipaparkan di domain sendiri.
        if ($landing = LandingBcl::untuk($kempen)) {
            return view('pages.landing', ['kempen' => $kempen, 'landing' => $landing]);
        }

        return view('pages.infak-kempen', ['kempen' => $kempen]);
    }

    public function soalanLazim()
    {
        return view('pages.soalan-lazim', ['soalan' => SoalanLazim::orderBy('susunan')->get()]);
    }

    public function sitemap(): Response
    {
        $urls = collect(['/', '/infak', '/impak', '/tentang', '/soalan-lazim', '/laporan', '/mohon-bantuan', '/sukarelawan', '/hubungi', '/ebook-percuma'])
            ->merge(Program::pluck('slug')->map(fn ($s) => "/program/$s"))
            ->merge(LaporanImpak::terbit()->pluck('bulan')->unique()->map(fn ($b) => "/impak/$b"));
        $urls = $urls->merge($urls->map(fn ($u) => rtrim('/en'.$u, '/')));

        return response()->view('sitemap', ['urls' => $urls], 200)->header('Content-Type', 'application/xml');
    }
}
