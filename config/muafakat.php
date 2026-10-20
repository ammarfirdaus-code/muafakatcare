<?php

// Maklumat organisasi. Nilai sulit/berubah (WhatsApp, emel, alamat) boleh diisi melalui .env.
return [
    'nama' => 'Muafakat Care',
    'nama_pertubuhan' => 'Pertubuhan Kebajikan Muafakat Bakri',
    'no_ppm' => 'PPM-002-10-13032020',
    'tagline' => 'Care That Unites Communities',
    'pengenalan' => 'Muafakat Care ialah program Pertubuhan Kebajikan Muafakat Bakri (PPM-002-10-13032020), sebuah NGO kebajikan di Bakri, Muar, Johor.',
    'kawasan' => 'Bakri dan Muar, Johor',
    'alamat' => env('MC_ALAMAT'),
    'whatsapp' => env('MC_WHATSAPP'),   // format 60XXXXXXXXX
    'emel' => env('MC_EMEL'),
    'sosial' => array_filter([
        'Facebook' => env('MC_FACEBOOK'),
        'Instagram' => env('MC_INSTAGRAM'),
        'TikTok' => env('MC_TIKTOK'),
    ]),
    'bank' => [
        'nama' => 'Maybank Islamic',
        'no_akaun' => '5510 4353 5257',
        'pemegang' => 'Pertubuhan Kebajikan Muafakat Bakri',
    ],
    'pautan_infak_utama' => 'https://pertubuhankebajikanmuafakatbakri.bcl.my/form/infak-foodbank',
];
