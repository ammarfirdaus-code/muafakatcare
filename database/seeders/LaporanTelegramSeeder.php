<?php

namespace Database\Seeders;

use App\Models\LaporanImpak;
use App\Models\Program;
use Illuminate\Database\Seeder;

/**
 * Laporan lama yang disiarkan sendiri oleh pertubuhan di saluran Telegram rasmi (t.me/muafakatcare).
 * Angka dipetik tepat daripada pos asal; tiada jumlah baharu dikira. Lulus terbit: Ammar, 25 Nov 2026.
 * Selamat dijalankan berulang kali.
 */
class LaporanTelegramSeeder extends Seeder
{
    public function run(): void
    {
        $foodbank = Program::where('slug', 'foodbank')->value('id');
        $bantuan = Program::where('slug', 'bantuan')->value('id');
        $sumber = 'Sumbangan orang ramai';

        $laporan = [
            ['2026-04', $foodbank, [
                'tajuk' => 'Foodbank Mac hingga April 2026: 40 keluarga dibantu',
                'lokasi' => 'Bakri', 'penerima' => 40, 'sumber_dana' => $sumber,
                'nota' => 'Misi foodbank bagi Mac hingga April 2026 selesai. Seramai 40 buah keluarga yang memerlukan di sekitar Bakri menerima bantuan foodbank. Dilaporkan pada 21 April 2026.',
                'sumber_url' => 'https://t.me/muafakatcare/3068',
            ]],
            ['2026-01', null, [
                'tajuk' => 'Back to School 2026: 60 set untuk pelajar sekitar Bakri',
                'lokasi' => 'Bakri', 'sumber_dana' => $sumber,
                'nota' => 'Sebanyak 60 set sumbangan Back to School diagihkan kepada pelajar di sekitar Bakri. Setiap pelajar menerima beg sekolah dan alat tulis; yang benar-benar memerlukan turut menerima sumbangan wang tunai. Dilaporkan pada 14 Januari 2026.',
                'sumber_url' => 'https://t.me/muafakatcare/2894',
            ]],
            ['2025-12', $bantuan, [
                'tajuk' => 'Misi bantuan pasca banjir di Perlis',
                'lokasi' => 'Kangar, Perlis', 'tarikh_agihan' => '2025-12-10', 'penerima' => 200,
                'nota' => 'Muafakat Care menyertai misi bersama Khidmat Malaysia dan rakan NGO lain. Seramai 200 keluarga menerima bakul makanan dan keperluan asas. Konvoi melibatkan 120 sukarelawan dan 34 kenderaan, membawa 800 pek makanan dan 200 beg beras. Angka ini ialah jumlah keseluruhan misi bersama.',
                'sumber_url' => 'https://t.me/muafakatcare/2842',
            ]],
            ['2025-12', $foodbank, [
                'tajuk' => 'Foodbank 2025: 30 hingga 50 set setiap bulan',
                'sumber_dana' => $sumber,
                'nota' => 'Sepanjang 2025, sekitar 30 hingga 50 set foodbank disalurkan setiap bulan kepada penerima tetap. Dilaporkan pada 31 Disember 2025.',
                'sumber_url' => 'https://t.me/muafakatcare/2858',
            ]],
            ['2025-03', null, [
                'tajuk' => 'Infak Kasih Ramadan 2025: 512 kotak disalurkan',
                'sumber_dana' => $sumber,
                'nota' => 'Sebanyak 512 kotak sumbangan Infak Kasih Ramadan disalurkan kepada mereka yang memerlukan. Dilaporkan pada 27 Mac 2025.',
                'sumber_url' => 'https://t.me/muafakatcare/2451',
            ]],
            ['2023-04', null, [
                'tajuk' => 'Laporan Ramadan 1444H: 500 penerima set barangan asas',
                'penerima' => 500, 'sumber_dana' => $sumber,
                'nota' => 'Aktiviti kebajikan sepanjang Ramadan 1444H: 500 penerima set barangan asas, 1 penerima sumbangan bencana, 6 penerima sumbangan wang tunai dan 1 pengguna baharu katil hospital wakaf. Dilaporkan pada 26 April 2023.',
                'sumber_url' => 'https://t.me/muafakatcare/501',
            ]],
            ['2023-02', $bantuan, [
                'tajuk' => 'Bantuan banjir Sri Medan: 79 set barangan kering',
                'lokasi' => 'Sri Medan', 'tarikh_agihan' => '2023-02-01', 'sumber_dana' => $sumber,
                'nota' => 'Sejumlah 79 set barangan kering berbungkus dibawa kepada mangsa banjir di Sri Medan.',
                'sumber_url' => 'https://t.me/muafakatcare/130',
            ]],
        ];

        foreach ($laporan as [$bulan, $program, $data]) {
            LaporanImpak::updateOrCreate(['bulan' => $bulan, 'program_id' => $program], $data + ['terbit' => true]);
        }
    }
}
