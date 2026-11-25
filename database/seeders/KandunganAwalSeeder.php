<?php

namespace Database\Seeders;

use App\Models\KaunterImpak;
use App\Models\Kempen;
use App\Models\Program;
use App\Models\SoalanLazim;
use Illuminate\Database\Seeder;

/**
 * Kandungan awal website. Angka impak = null sehingga Ammar sahkan (JANGAN reka).
 * Selamat dijalankan berulang kali (updateOrCreate).
 */
class KandunganAwalSeeder extends Seeder
{
    public function run(): void
    {
        Program::updateOrCreate(['slug' => 'foodbank'], [
            'ikon' => '🍚', 'nama' => 'Foodbank Bulanan', 'satu_baris' => 'Pek makanan asas setiap bulan untuk asnaf, ibu tunggal, warga emas dan B40.',
            'tldr' => 'Foodbank Bulanan Muafakat Care mengagihkan pek makanan asas kepada keluarga yang memerlukan di Bakri dan Muar, Johor, setiap bulan. Satu pek makanan asas bernilai RM50.',
            'apa_kami_buat' => ['Senarai penerima disemak oleh pasukan sukarelawan setiap bulan.', 'Barang dibeli, dibungkus dan dihantar ke rumah penerima.', 'Setiap agihan direkod dan dikongsi di Papan Impak.'],
            'kos_seunit' => 'RM50 = 1 pek makanan asas', 'isi_pek' => [],
            'faq' => [['s' => 'Berapa kos satu pek foodbank?', 'j' => 'RM50 untuk satu pek makanan asas. Infak ikut kemampuan, RM10 pun diterima.'], ['s' => 'Siapa penerima foodbank?', 'j' => 'Asnaf, ibu tunggal, warga emas dan keluarga B40 di kawasan Bakri dan Muar yang disemak oleh pasukan kami.']], 'susunan' => 0,
        ]);
        Program::updateOrCreate(['slug' => 'wakaf-katil'], [
            'ikon' => '🛏️', 'nama' => 'Wakaf Katil Hospital', 'satu_baris' => 'Katil hospital untuk pesakit terlantar di rumah, dipinjamkan tanpa caj.',
            'tldr' => 'Program Wakaf Katil Hospital Muafakat Care meminjamkan katil hospital tanpa caj kepada keluarga yang menjaga pesakit terlantar di rumah. Bila tidak digunakan lagi, katil dipulangkan untuk pesakit seterusnya.',
            'apa_kami_buat' => ['Keluarga pesakit memohon melalui WhatsApp atau borang.', 'Pasukan kami hantar dan pasang katil di rumah.', 'Katil dipulangkan bila tidak diperlukan, dan disalurkan kepada pesakit lain.'],
            'kos_seunit' => 'RM50 = 1 slot wakaf', 'isi_pek' => [],
            'faq' => [['s' => 'Ada caj pinjam katil?', 'j' => 'Tiada caj. Katil ini hasil wakaf orang ramai.']], 'susunan' => 1,
        ]);
        Program::updateOrCreate(['slug' => 'sedekah-subuh'], [
            'ikon' => '🌅', 'nama' => 'Sedekah Subuh & Infak Jumaat', 'satu_baris' => 'Infak harian dan mingguan kecil yang disalurkan kepada program bulanan.',
            'tldr' => 'Sedekah Subuh dan Infak Jumaat membolehkan sesiapa sahaja menyumbang serendah RM1. Dana dikumpul dan disalurkan kepada program kebajikan Muafakat Care.',
            'apa_kami_buat' => ['Infak dikumpul melalui pautan BCL rasmi.', 'Dana disalurkan kepada program bulanan seperti foodbank dan bantuan kecemasan.'],
            'kos_seunit' => 'Serendah RM1', 'isi_pek' => [],
            'faq' => [], 'susunan' => 2,
        ]);
        Program::updateOrCreate(['slug' => 'bantuan'], [
            'ikon' => '🤝', 'nama' => 'Bantuan Ziarah & Kecemasan', 'satu_baris' => 'Ziarah, baik pulih rumah dan bantuan segera kepada keluarga terjejas.',
            'tldr' => 'Muafakat Care menziarahi dan membantu keluarga yang terjejas akibat musibah, sakit atau kecemasan di kawasan Bakri dan Muar.',
            'apa_kami_buat' => ['Permohonan diterima melalui borang Mohon Bantuan atau WhatsApp.', 'Pasukan menyemak keperluan sebelum bantuan disalurkan.'],
            'kos_seunit' => null, 'isi_pek' => [],
            'faq' => [], 'susunan' => 3,
        ]);

        Kempen::updateOrCreate(['slug' => 'foodbank'], [
            'program_id' => Program::where('slug', 'foodbank')->value('id'),
            'aktif' => true, 'label' => 'Kempen bulan ini', 'tajuk' => 'Foodbank Bulanan',
            'ringkas' => 'Bantu isi dapur keluarga asnaf, ibu tunggal dan warga emas di Bakri & Muar. Pek makanan asas dihantar terus ke rumah penerima.',
            'hero_sorotan' => 'RM50', 'hero_ayat' => '= satu pek makanan asas.',
            'unit' => 'pek', 'sasaran' => null, 'terkumpul' => null,  // sasaran bulanan: isi bila Ammar sahkan
            'pautan_bcl' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-foodbank',
            'susunan' => 0,
        ]);
        Kempen::updateOrCreate(['slug' => 'wakaf-katil'], [
            'program_id' => Program::where('slug', 'wakaf-katil')->value('id'),
            'aktif' => true, 'label' => 'Wakaf', 'tajuk' => 'Wakaf Katil Hospital',
            'ringkas' => 'Katil hospital untuk pesakit terlantar di rumah, dipinjamkan tanpa caj dan dipulangkan bila tak diperlukan.',
            'hero_sorotan' => 'Satu katil', 'hero_ayat' => 'untuk pesakit seterusnya.',
            'unit' => 'katil', 'sasaran' => null, 'terkumpul' => null,
            'pautan_bcl' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/katil-hospital-wakaf',
            'susunan' => 1,
        ]);
        Kempen::updateOrCreate(['slug' => 'tabung-banjir'], [
            'program_id' => Program::where('slug', 'bantuan')->value('id'),
            'aktif' => true, 'label' => 'Siap siaga', 'tajuk' => 'Tabung Banjir Siap Siaga',
            'ringkas' => 'Pek makanan dan kit kebersihan disediakan lebih awal, kemudian dihantar terus ke lokasi banjir.',
            'hero_sorotan' => 'Siap siaga', 'hero_ayat' => 'sebelum banjir tiba.',
            'unit' => 'RM', 'sasaran' => null, 'terkumpul' => null,
            'pautan_bcl' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/banjir-selangor-pantai-timur',
            'susunan' => 2,
        ]);
        Kempen::updateOrCreate(['slug' => 'infak-subuh'], [
            'program_id' => Program::where('slug', 'sedekah-subuh')->value('id'),
            'aktif' => true, 'label' => 'Harian', 'tajuk' => 'Sedekah Subuh',
            'ringkas' => 'Infak kecil setiap pagi, serendah RM1, disalurkan kepada program bulanan.',
            'hero_sorotan' => 'Serendah RM1', 'hero_ayat' => 'mulakan pagi dengan sedekah.',
            'unit' => 'RM', 'sasaran' => null, 'terkumpul' => null,
            'pautan_bcl' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-subuh',
            'susunan' => 3,
        ]);
        Kempen::updateOrCreate(['slug' => 'infak-jumaat'], [
            'program_id' => Program::where('slug', 'sedekah-subuh')->value('id'),
            'aktif' => true, 'label' => 'Mingguan', 'tajuk' => 'Infak Jumaat',
            'ringkas' => 'Sedekah penghulu hari, setiap Jumaat, untuk program kebajikan Muafakat Care.',
            'unit' => 'RM', 'sasaran' => null, 'terkumpul' => null,
            'pautan_bcl' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-jumaat',
            'susunan' => 4,
        ]);

        KaunterImpak::updateOrCreate(['label' => 'Pek foodbank diagihkan'], ['nilai' => null, 'susunan' => 0]);
        KaunterImpak::updateOrCreate(['label' => 'Katil hospital disalurkan'], ['nilai' => null, 'susunan' => 1]);
        KaunterImpak::updateOrCreate(['label' => 'Keluarga dibantu'], ['nilai' => null, 'susunan' => 2]);
        KaunterImpak::updateOrCreate(['label' => 'Tahun berkhidmat'], ['nilai' => null, 'susunan' => 3]);

        SoalanLazim::updateOrCreate(['soalan' => 'Apa itu Muafakat Care?'], ['jawapan' => 'Muafakat Care ialah program Pertubuhan Kebajikan Muafakat Bakri (PPM-002-10-13032020), sebuah NGO kebajikan di Bakri, Muar, Johor yang menjalankan foodbank bulanan, wakaf katil hospital, sedekah subuh dan bantuan kecemasan.', 'susunan' => 0]);
        SoalanLazim::updateOrCreate(['soalan' => 'Adakah Muafakat Care berdaftar?'], ['jawapan' => 'Ya. Muafakat Care berada di bawah Pertubuhan Kebajikan Muafakat Bakri, berdaftar dengan Jabatan Pendaftaran Pertubuhan Malaysia (ROS), no. PPM-002-10-13032020.', 'susunan' => 1]);
        SoalanLazim::updateOrCreate(['soalan' => 'Kawasan mana yang dibantu?'], ['jawapan' => 'Fokus utama kami ialah kawasan Bakri dan Muar, Johor.', 'susunan' => 2]);
        SoalanLazim::updateOrCreate(['soalan' => 'Berapa kos satu pek foodbank?'], ['jawapan' => 'RM50 untuk satu pek makanan asas. Infak ikut kemampuan, RM10 pun diterima.', 'susunan' => 3]);
        SoalanLazim::updateOrCreate(['soalan' => 'Bagaimana saya tahu infak saya sampai?'], ['jawapan' => 'Setiap agihan direkod dan dilaporkan di Papan Impak, lengkap dengan tarikh, bilangan penerima dan kos.', 'susunan' => 4]);
        SoalanLazim::updateOrCreate(['soalan' => 'Akaun mana yang sah untuk infak?'], ['jawapan' => 'Hanya pautan BCL rasmi dan akaun Maybank Islamic atas nama Pertubuhan Kebajikan Muafakat Bakri. Kami tidak pernah meminta infak ke akaun peribadi.', 'susunan' => 5]);
        SoalanLazim::updateOrCreate(['soalan' => 'Bagaimana nak mohon bantuan?'], ['jawapan' => 'Isi borang di halaman Mohon Bantuan atau hubungi kami melalui WhatsApp. Pasukan kami akan menyemak permohonan anda.', 'susunan' => 6]);
    }
}
