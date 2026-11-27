<?php

// Pautan ikut bahasa semasa: BM tanpa awalan, Inggeris di bawah /en.
if (! function_exists('lr')) {
    function lr(string $nama, mixed $param = []): string
    {
        return route((app()->getLocale() === 'en' ? 'en.' : '').$nama, $param);
    }
}

// Gaya object-position untuk gambar yang dipotong, ikut config('muafakat.fokus').
if (! function_exists('fokus')) {
    function fokus(?string $gambar): string
    {
        return 'object-position: '.(config('muafakat.fokus')[$gambar] ?? '50% 50%');
    }
}
