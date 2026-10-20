<?php

use App\Http\Controllers\BorangController;
use App\Http\Controllers\HalamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HalamanController::class, 'utama'])->name('utama');
Route::get('/program/{program}', [HalamanController::class, 'program'])->name('program');
Route::get('/impak', [HalamanController::class, 'impak'])->name('impak');
Route::get('/impak/{bulan}', [HalamanController::class, 'impakBulan'])->where('bulan', '\d{4}-\d{2}')->name('impak.bulan');
Route::get('/infak', [HalamanController::class, 'infak'])->name('infak');
Route::get('/soalan-lazim', [HalamanController::class, 'soalanLazim'])->name('soalan-lazim');
Route::get('/sitemap.xml', [HalamanController::class, 'sitemap']);

Route::view('/tentang', 'pages.tentang')->name('tentang');
Route::view('/laporan', 'pages.laporan')->name('laporan');
Route::view('/hubungi', 'pages.hubungi')->name('hubungi');
Route::view('/privasi', 'pages.privasi')->name('privasi');
Route::view('/terima-kasih', 'pages.terima-kasih')->name('terima-kasih');
Route::view('/mohon-bantuan', 'pages.mohon-bantuan')->name('mohon-bantuan');
Route::view('/sukarelawan', 'pages.sukarelawan')->name('sukarelawan');

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/mohon-bantuan', [BorangController::class, 'mohonBantuan'])->name('mohon-bantuan.hantar');
    Route::post('/sukarelawan', [BorangController::class, 'sukarelawan'])->name('sukarelawan.hantar');
});
