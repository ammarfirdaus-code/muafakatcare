<?php

// Pautan ikut bahasa semasa: BM tanpa awalan, Inggeris di bawah /en.
if (! function_exists('lr')) {
    function lr(string $nama, mixed $param = []): string
    {
        return route((app()->getLocale() === 'en' ? 'en.' : '').$nama, $param);
    }
}
