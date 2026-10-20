<?php

namespace App\Http\Controllers;

use App\Models\KaunterImpak;
use App\Models\Kempen;
use App\Models\LaporanImpak;
use App\Models\Program;
use App\Models\SoalanLazim;
use Illuminate\Http\Response;

class HalamanController extends Controller
{
    public function utama()
    {
        return view('pages.utama', [
            'kempens' => Kempen::aktif()->get(),
            'programs' => Program::orderBy('susunan')->get(),
            'kaunter' => KaunterImpak::orderBy('susunan')->get(),
            'laporan' => LaporanImpak::terbit()->take(3)->get(),
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

    public function soalanLazim()
    {
        return view('pages.soalan-lazim', ['soalan' => SoalanLazim::orderBy('susunan')->get()]);
    }

    public function sitemap(): Response
    {
        $urls = collect(['/', '/infak', '/impak', '/tentang', '/soalan-lazim', '/laporan', '/mohon-bantuan', '/sukarelawan', '/hubungi'])
            ->merge(Program::pluck('slug')->map(fn ($s) => "/program/$s"))
            ->merge(LaporanImpak::terbit()->pluck('bulan')->unique()->map(fn ($b) => "/impak/$b"));

        return response()->view('sitemap', ['urls' => $urls], 200)->header('Content-Type', 'application/xml');
    }
}
