<?php

// Maklumat organisasi. Nilai sulit/berubah (WhatsApp, emel, alamat) boleh diisi melalui .env.
return [
    'nama' => 'Muafakat Care',
    'nama_pertubuhan' => 'Pertubuhan Kebajikan Muafakat Bakri',
    'no_ppm' => 'PPM-002-10-13032020',
    'tagline' => 'Care That Unites Communities',
    'pengenalan' => 'Muafakat Care ialah program Pertubuhan Kebajikan Muafakat Bakri (PPM-002-10-13032020), sebuah NGO kebajikan di Bakri, Muar, Johor.',
    // Sumber: dokumen strategi jenama (asas DESIGN v2).
    'misi' => [
        'Membantu kebajikan masyarakat melalui bantuan makanan, kesihatan, pendidikan agama, bantuan kecemasan dan sokongan komuniti.',
        'Menjadi gerakan kebajikan komuniti yang dipercayai, konsisten dan dekat dengan mereka yang memerlukan.',
    ],
    // Sumber: laman web lama pertubuhan (Canva, 2025).
    'pasukan' => [
        'Sukri Basir' => 'Pengerusi',
        'Ts. Mahmod' => 'Timbalan Pengerusi',
        'Firdaus Shahir' => 'Setiausaha',
        'Normala Ali' => 'Bendahari',
        'Mohmad Anuar' => 'Ahli Jawatankuasa',
        'Norzathy Nazar' => 'Ahli Jawatankuasa',
        'Amirul Kahar' => 'Ahli Jawatankuasa',
        'Ibrahim Pairan' => 'Ahli Jawatankuasa',
    ],
    // Titik fokus gambar bila dipotong dalam bingkai (object-position). Lalai: tengah.
    'fokus' => [
        'img/foto/puan-seri.jpg' => '50% 18%',
        'img/foto/katil-pasang.jpg' => '50% 100%',
        'img/foto/hantar-kotak.jpg' => '50% 15%',
        'img/foto/van-bekalan.jpg' => '50% 10%',
        'img/foto/hantar-pintu.jpg' => '50% 20%',
        'img/foto/pek-bantuan.jpg' => '50% 40%',
        'img/foto/serahan.jpg' => '50% 30%',
    ],
    'kawasan' => 'Bakri dan Muar, Johor',
    'alamat' => env('MC_ALAMAT', 'JBB 29, Kampung Jeram Masjid, 84000 Muar, Johor'),
    'whatsapp' => env('MC_WHATSAPP', '601112240882'),   // format 60XXXXXXXXX
    'emel' => env('MC_EMEL', 'muafakatbakri@gmail.com'),
    // Akaun rasmi (boleh ditindih melalui .env; nilai kosong = sembunyi).
    'sosial' => array_filter([
        'Facebook' => env('MC_FACEBOOK', 'https://www.facebook.com/muafakatcare'),
        'Instagram' => env('MC_INSTAGRAM', 'https://www.instagram.com/ngomuafakatcare'),
        'TikTok' => env('MC_TIKTOK', 'https://www.tiktok.com/@muafakatcare'),
        'Telegram' => env('MC_TELEGRAM', 'https://t.me/muafakatcare'),
    ]),
    'bank' => [
        'nama' => 'Maybank Islamic',
        'no_akaun' => '5510 4353 5257',
        'pemegang' => 'Pertubuhan Kebajikan Muafakat Bakri',
    ],
    'pautan_infak_utama' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-foodbank',
];
