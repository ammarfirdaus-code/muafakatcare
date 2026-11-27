<?php

namespace App\Support;

use App\Models\Kempen;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Menyalin landing page kempen daripada halaman BCL pertubuhan sendiri supaya ia dipaparkan
 * di muafakatcare.my. Kandungan ditarik terus dari BCL (dicache 6 jam) dan jatuh balik kepada
 * salinan dalam resources/landing jika BCL tidak dapat dihubungi.
 */
class LandingBcl
{
    public static function untuk(Kempen $kempen): ?string
    {
        if ($kempen->urlBenam() === null) {
            return null;
        }

        $slug = basename(parse_url($kempen->pautan_bcl, PHP_URL_PATH));

        if (! app()->runningUnitTests()) {
            $hidup = Cache::remember('landing-bcl:'.$slug, now()->addHours(6), function () use ($kempen) {
                try {
                    $r = Http::timeout(8)->withUserAgent('Mozilla/5.0 (muafakatcare.my)')->get($kempen->pautan_bcl);

                    return $r->successful() ? self::petik($r->body()) : null;
                } catch (\Throwable $e) {
                    report($e);

                    return null;
                }
            });
            if ($hidup) {
                return self::tapis($hidup);
            }
        }

        $fail = resource_path('landing/'.$slug.'.html');

        return is_file($fail) ? self::tapis(file_get_contents($fail)) : null;
    }

    /**
     * Sembunyikan suapan "penyumbang baru sahaja infak" yang direka (nama dan jumlah contoh, bukan
     * transaksi sebenar). Laman ini tidak memaparkan rekod sumbangan yang tidak benar.
     */
    public static function tapis(string $isi): string
    {
        if (str_contains($isi, 'id="pop-name"')) {
            $isi .= '<style>#pop{display:none!important}</style>';
        }

        return $isi;
    }

    /** Ambil isi <div id="content-container"> daripada halaman borang BCL. */
    public static function petik(string $html): ?string
    {
        $mula = '<div id="content-container">';
        $i = strpos($html, $mula);
        $j = strrpos($html, '</main>');
        if ($i === false || $j === false || $j < $i) {
            return null;
        }

        $isi = rtrim(substr($html, $i + strlen($mula), $j - $i - strlen($mula)));
        // Buang penutup pembalut BCL di hujung sehingga tag div seimbang.
        while (substr_count($isi, '</div>') > substr_count($isi, '<div') && str_ends_with($isi, '</div>')) {
            $isi = rtrim(substr($isi, 0, -6));
        }

        return (strlen($isi) > 500 && str_contains($isi, 'bcl')) ? $isi : null;
    }
}
