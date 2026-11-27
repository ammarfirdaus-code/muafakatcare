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

    public function test_versi_inggeris_dibuka_dan_diterjemah(): void
    {
        foreach (['/en', '/en/infak', '/en/impak', '/en/tentang', '/en/soalan-lazim', '/en/laporan', '/en/mohon-bantuan', '/en/sukarelawan', '/en/hubungi', '/en/privasi', '/en/program/foodbank'] as $url) {
            $this->get($url)->assertOk()->assertSee('<html lang="en">', false);
        }

        $this->get('/en')
            ->assertSee('Monthly Foodbank')
            ->assertSee('one basic food pack')
            ->assertSee('OUR MISSION')
            ->assertSee('href="'.url('/en/infak').'"', false)
            ->assertDontSee('MISI KAMI');
        $this->get('/')->assertSee('<html lang="ms">', false)->assertSee('MISI KAMI')->assertSee('hreflang="en"', false);
        $this->get('/en/tentang')->assertSee('since 2020')->assertSee('Chairman');
    }

    public function test_borang_inggeris_kekal_dalam_bahasa_inggeris(): void
    {
        $this->post('/en/mohon-bantuan', [
            'nama' => 'Test', 'telefon' => '012-3456789', 'kawasan' => 'Bakri',
            'jenis' => 'Foodbank', 'setuju' => '1',
        ])->assertRedirect('/en/terima-kasih');
    }

    public function test_halaman_ebook_papar_sepuluh_ebook_dan_fail_wujud(): void
    {
        $this->assertCount(10, config('ebook'));
        $r = $this->get('/ebook-percuma')->assertOk();
        foreach (config('ebook') as $e) {
            $r->assertSee($e['tajuk']);
            $this->assertFileExists(public_path('ebook/'.$e['slug'].'.pdf'));
            $this->assertFileExists(public_path('img/ebook/'.$e['slug'].'.jpg'));
        }
        $this->get('/en/ebook-percuma')->assertOk()->assertSee('Download eBook');
    }

    public function test_laman_utama_papar_kempen_dan_pautan_bcl(): void
    {
        $this->get('/')
            ->assertSee('Foodbank Bulanan')
            ->assertSee('RM50')
            ->assertDontSee('Sertai Sukarelawan')
            ->assertSee('t.me/muafakatcare', false)
            ->assertSee('wa.me/601112240882', false)
            ->assertSee('84000 Muar')
            ->assertSee('pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-foodbank', false)
            ->assertSee('PPM-002-10-13032020')
            ->assertSee('Pengguna katil hospital aktif')
            ->assertSee('data-kira="15"', false);
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

    public function test_laporan_telegram_diterbitkan_dengan_sumber(): void
    {
        $this->seed(\Database\Seeders\LaporanTelegramSeeder::class);
        $this->seed(\Database\Seeders\LaporanTelegramSeeder::class); // selamat diulang
        $this->assertSame(14, LaporanImpak::count());
        $this->get('/impak')->assertSee('Bantuan Palestin: RM50,000 diserahkan kepada Cinta Gaza Malaysia')->assertSee('img/ilustrasi/bantuan-palestin.jpg', false);

        $this->get('/')->assertSee('40 keluarga dibantu')->assertDontSee('Laporan agihan bulanan akan dipaparkan di sini');
        $this->get('/impak/2026-04')->assertOk()->assertSee('t.me/muafakatcare/3068', false);
        $this->get('/en/impak/2025-12')->assertOk()->assertSee('Post-flood relief mission in Perlis')->assertSee('200');
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
