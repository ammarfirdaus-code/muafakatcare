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
        $palestin = 'img/laporan/bantuan-palestin.jpg';

        $laporan = [
            ['2026-04', $foodbank, [
                'tajuk' => 'Foodbank Mac hingga April 2026: 40 keluarga dibantu',
                'lokasi' => 'Bakri', 'penerima' => 40, 'sumber_dana' => $sumber,
                'nota' => 'Misi foodbank bagi Mac hingga April 2026 selesai. Seramai 40 buah keluarga yang memerlukan di sekitar Bakri menerima bantuan foodbank. Dilaporkan pada 21 April 2026.',
                'sumber_url' => 'https://t.me/muafakatcare/3068',
                'gambar' => ['img/laporan/hantar-rumah.svg'],
            ]],
            ['2026-01', null, [
                'tajuk' => 'Back to School 2026: 60 set untuk pelajar sekitar Bakri',
                'lokasi' => 'Bakri', 'sumber_dana' => $sumber,
                'nota' => 'Sebanyak 60 set sumbangan Back to School diagihkan kepada pelajar di sekitar Bakri. Setiap pelajar menerima beg sekolah dan alat tulis; yang benar-benar memerlukan turut menerima sumbangan wang tunai. Dilaporkan pada 14 Januari 2026.',
                'sumber_url' => 'https://t.me/muafakatcare/2894',
                'gambar' => ['img/laporan/beg-sekolah.svg'],
            ]],
            ['2025-12', $bantuan, [
                'tajuk' => 'Misi bantuan pasca banjir di Perlis',
                'lokasi' => 'Kangar, Perlis', 'tarikh_agihan' => '2025-12-10', 'penerima' => 200,
                'nota' => 'Muafakat Care menyertai misi bersama Khidmat Malaysia dan rakan NGO lain. Seramai 200 keluarga menerima bakul makanan dan keperluan asas. Konvoi melibatkan 120 sukarelawan dan 34 kenderaan, membawa 800 pek makanan dan 200 beg beras. Angka ini ialah jumlah keseluruhan misi bersama.',
                'sumber_url' => 'https://t.me/muafakatcare/2842',
                'gambar' => ['img/laporan/trak-banjir.jpg'],
            ]],
            ['2025-12', $foodbank, [
                'tajuk' => 'Foodbank 2025: 30 hingga 50 set setiap bulan',
                'sumber_dana' => $sumber,
                'nota' => 'Sepanjang 2025, sekitar 30 hingga 50 set foodbank disalurkan setiap bulan kepada penerima tetap. Dilaporkan pada 31 Disember 2025.',
                'sumber_url' => 'https://t.me/muafakatcare/2858',
                'gambar' => ['img/laporan/stok-foodbank.jpg'],
            ]],
            ['2025-03', null, [
                'tajuk' => 'Infak Kasih Ramadan 2025: 512 kotak disalurkan',
                'sumber_dana' => $sumber,
                'nota' => 'Sebanyak 512 kotak sumbangan Infak Kasih Ramadan disalurkan kepada mereka yang memerlukan. Dilaporkan pada 27 Mac 2025.',
                'sumber_url' => 'https://t.me/muafakatcare/2451',
                'gambar' => ['img/laporan/kotak-ramadan.jpg'],
            ]],
            ['2023-04', null, [
                'tajuk' => 'Laporan Ramadan 1444H: 500 penerima set barangan asas',
                'penerima' => 500, 'sumber_dana' => $sumber,
                'nota' => 'Aktiviti kebajikan sepanjang Ramadan 1444H: 500 penerima set barangan asas, 1 penerima sumbangan bencana, 6 penerima sumbangan wang tunai dan 1 pengguna baharu katil hospital wakaf. Dilaporkan pada 26 April 2023.',
                'sumber_url' => 'https://t.me/muafakatcare/501',
                'gambar' => ['img/laporan/serah-kotak.jpg'],
            ]],
            ['2023-02', $bantuan, [
                'tajuk' => 'Bantuan banjir Sri Medan: 79 set barangan kering',
                'lokasi' => 'Sri Medan', 'tarikh_agihan' => '2023-02-01', 'sumber_dana' => $sumber,
                'nota' => 'Sejumlah 79 set barangan kering berbungkus dibawa kepada mangsa banjir di Sri Medan.',
                'sumber_url' => 'https://t.me/muafakatcare/130',
                'gambar' => ['img/laporan/trak-banjir.jpg'],
            ]],
            // Bantuan Palestin: serahan yang dihebahkan sendiri oleh pertubuhan. Jumlah tidak dicampur.
            ['2024-12', null, [
                'tajuk' => 'Bantuan Palestin: susu formula dan lampin untuk 172 bayi di Khan Yunis',
                'lokasi' => 'Khan Yunis, Gaza', 'tarikh_agihan' => '2024-12-20', 'penerima' => 172, 'sumber_dana' => $sumber,
                'nota' => 'Pada 20 Disember 2024, sebanyak 172 bayi di Khan Yunis menerima bantuan susu formula dan lampin, disalurkan bersama Cinta Gaza Malaysia.',
                'sumber_url' => 'https://t.me/muafakatcare/2190', 'gambar' => [$palestin],
            ]],
            ['2024-10', null, [
                'tajuk' => 'Bantuan Palestin: makanan panas, air bersih dan sayur untuk Gaza',
                'lokasi' => 'Gaza', 'sumber_dana' => $sumber,
                'nota' => 'Program Hot Meal For Gaza dilaksanakan pada 25 dan 26 September 2024. Pada Oktober 2024, bantuan air bersih dan sayur-sayuran segar turut sampai kepada penduduk Gaza. Semua bantuan disalurkan melalui Cinta Gaza Malaysia dan sukarelawan di sana.',
                'sumber_url' => 'https://t.me/muafakatcare/1805', 'gambar' => [$palestin],
            ]],
            ['2024-07', null, [
                'tajuk' => 'Bantuan Palestin: serahan kali ke-5, RM50,000 kepada Cinta Gaza Malaysia',
                'tarikh_agihan' => '2024-07-10', 'kos' => 50000, 'sumber_dana' => $sumber,
                'nota' => 'Bersama Pertubuhan Kebajikan At-Tanwiriah Malaysia, sumbangan kali ke-5 sebanyak RM50,000 diserahkan kepada Cinta Gaza Malaysia.',
                'sumber_url' => 'https://t.me/muafakatcare/1641', 'gambar' => [$palestin],
            ]],
            ['2024-02', null, [
                'tajuk' => 'Bantuan Palestin: RM50,000 diserahkan kepada Cinta Gaza Malaysia',
                'tarikh_agihan' => '2024-02-01', 'kos' => 50000, 'sumber_dana' => $sumber,
                'nota' => 'Pertubuhan Kebajikan Muafakat Bakri dan Pertubuhan Kebajikan At-Tanwiriah menyerahkan sejumlah RM50,000 kepada Cinta Gaza Malaysia, hasil sumbangan orang ramai.',
                'sumber_url' => 'https://t.me/muafakatcare/1286', 'gambar' => [$palestin],
            ]],
            ['2024-01', null, [
                'tajuk' => 'Bantuan Palestin: RM20,000 diserahkan kepada Cinta Gaza Malaysia',
                'kos' => 20000, 'sumber_dana' => $sumber,
                'nota' => 'Pertubuhan Kebajikan Muafakat Bakri dan Pertubuhan Kebajikan At-Tanwiriah Malaysia menyerahkan sumbangan sebanyak RM20,000 kepada Cinta Gaza Malaysia. Dilaporkan pada 11 Januari 2024.',
                'sumber_url' => 'https://t.me/muafakatcare/1201', 'gambar' => [$palestin],
            ]],
            ['2023-12', null, [
                'tajuk' => 'Bantuan Palestin: RM10,000 diserahkan kepada Cinta Gaza Malaysia',
                'tarikh_agihan' => '2023-12-15', 'kos' => 10000, 'sumber_dana' => $sumber,
                'nota' => 'Selepas Forum Taufan Al-Aqsa, Pertubuhan Kebajikan Muafakat Bakri dan Pertubuhan Kebajikan At-Tanwiriah Malaysia menyerahkan sumbangan sebanyak RM10,000 kepada Cinta Gaza Malaysia.',
                'sumber_url' => 'https://t.me/muafakatcare/1106', 'gambar' => [$palestin],
            ]],
            ['2023-11', null, [
                'tajuk' => 'Bantuan Palestin: serahan kepada Aid4Palestine dan MyAqsa Defenders',
                'sumber_dana' => $sumber,
                'nota' => 'Pada 20 November 2023, RM2,000 hasil kutipan orang ramai disumbangkan kepada dana Aid4Palestine. Pada 21 November 2023, kutipan sebanyak RM10,000 melalui Pertubuhan Kebajikan Muafakat Bakri dan Pertubuhan Kebajikan At-Tanwiriah Malaysia diserahkan kepada MyAqsa Defenders.',
                'sumber_url' => 'https://t.me/muafakatcare/903', 'gambar' => [$palestin],
            ]],
        ];

        foreach ($laporan as [$bulan, $program, $data]) {
            LaporanImpak::updateOrCreate(['bulan' => $bulan, 'program_id' => $program, 'sumber_url' => $data['sumber_url']], $data + ['terbit' => true]);
        }
    }
}
