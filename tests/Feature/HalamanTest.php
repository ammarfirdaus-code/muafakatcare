<?php

namespace Tests\Feature;

use App\Models\LaporanImpak;
use App\Models\PermohonanBantuan;
use Database\Seeders\KandunganAwalSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HalamanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(KandunganAwalSeeder::class);
    }

    public function test_semua_halaman_awam_dibuka(): void
    {
        foreach (['/', '/infak', '/impak', '/tentang', '/soalan-lazim', '/laporan', '/mohon-bantuan', '/sukarelawan', '/hubungi', '/privasi', '/program/foodbank', '/program/wakaf-katil', '/sitemap.xml'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_laman_utama_papar_kempen_dan_pautan_bcl(): void
    {
        $this->get('/')
            ->assertSee('Foodbank Bulanan')
            ->assertSee('RM50')
            ->assertDontSee('Sertai Sukarelawan')
            ->assertSee('t.me/muafakatcare', false)
            ->assertSee('pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-foodbank', false)
            ->assertSee('PPM-002-10-13032020');
    }

    public function test_kempen_tanpa_pautan_tidak_papar_butang_infak(): void
    {
        \App\Models\Kempen::where('slug', 'wakaf-katil')->update(['pautan_bcl' => null]);
        $this->get('/program/wakaf-katil')->assertSee('Pautan infak belum disahkan');
    }

    public function test_laporan_impak_draf_tidak_dipapar(): void
    {
        LaporanImpak::create(['bulan' => '2026-09', 'tajuk' => 'Draf rahsia', 'terbit' => false]);
        $this->get('/impak')->assertDontSee('Draf rahsia');
        $this->get('/impak/2026-09')->assertNotFound();

        LaporanImpak::create(['bulan' => '2026-08', 'tajuk' => 'Agihan Ogos', 'terbit' => true, 'penerima' => 40]);
        $this->get('/impak')->assertSee('Agihan Ogos');
        $this->get('/impak/2026-08')->assertOk()->assertSee('40');
    }

    public function test_borang_mohon_bantuan_disimpan(): void
    {
        $this->post('/mohon-bantuan', [
            'nama' => 'Ujian', 'telefon' => '012-3456789', 'kawasan' => 'Bakri',
            'jenis' => 'Foodbank', 'tanggungan' => 3, 'setuju' => '1',
        ])->assertRedirect('/terima-kasih');

        $this->assertDatabaseHas('permohonan_bantuans', ['nama' => 'Ujian', 'status' => 'baru']);
    }

    public function test_borang_tolak_tanpa_persetujuan_dan_spam(): void
    {
        $this->post('/mohon-bantuan', ['nama' => 'A', 'telefon' => '0123456789', 'kawasan' => 'B', 'jenis' => 'Foodbank'])
            ->assertSessionHasErrors('setuju');
        $this->post('/mohon-bantuan', ['laman_web' => 'spam', 'nama' => 'A'])->assertStatus(422);
        $this->assertSame(0, PermohonanBantuan::count());
    }
}
