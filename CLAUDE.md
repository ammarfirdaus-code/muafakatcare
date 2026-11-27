# Muafakat Care Website — nota untuk ejen (Ilham)

Laravel 13 (PHP 8.3+), Blade, CSS biasa di `public/css/app.css` (tiada Vite/npm). Deploy: Laravel Forge, domain muafakatcare.my.

## Peraturan
- Bahasa paparan: dwibahasa. Bahasa Melayu (utama, tanpa awalan) dan Inggeris di `/en`. Teks ditulis dalam BM dalam paparan/seeder dan dibungkus `__()`; terjemahan Inggeris di `lang/en.json` (kunci = ayat BM). Teks baharu mesti ditambah ke situ, jika tidak ia kekal BM di `/en`. Guna `lr('nama-laluan')`, bukan `route()`, dalam paparan. Ikut jenama `02_MUAFAKAT-CARE/_BRAND/2026-10-01_DESIGN-MuafakatCare_v2.md` (token warna di `:root` app.css).
- JANGAN reka angka impak. Medan `null` dipapar "akan dikemas kini". Angka kempen mesti tally dengan bank + BCL.
- Maruah penerima: tiada nama penuh, alamat, IC dalam laporan impak. Gambar berizin sahaja; wajah kanak-kanak dikaburkan.
- `permohonan_bantuans` & `sukarelawans` = data peribadi (PDPA). Jangan salin ke log, seeder, slide atau chat.
- Tiada deploy/push ke main tanpa "lulus" Ammar. Jalankan `php artisan test` sebelum PR.

## Struktur
- Maklumat organisasi: `config/muafakat.php` (+ `.env` MC_*).
- Kandungan: jadual `programs`, `kempens`, `laporan_impaks`, `kaunter_impaks`, `soalan_lazims`. Data awal: `database/seeders/KandunganAwalSeeder.php` (selamat diulang).
- Halaman: `app/Http/Controllers/HalamanController.php`, borang: `BorangController.php`, laluan: `routes/web.php`, paparan: `resources/views/`.
- Ujian: `tests/Feature/HalamanTest.php`.

## Landing page kempen
- `/infak/{kempen}` memaparkan landing page yang sama seperti di BCL (`app/Support/LandingBcl.php`): ditarik terus dari halaman BCL kempen, dicache 6 jam, dengan salinan sandaran di `resources/landing/`. Sunting landing di BCL; laman mengikut dalam masa 6 jam.
- Suapan "penyumbang baru sahaja infak" yang direka disembunyikan di laman ini. Jangan paparkan rekod sumbangan yang bukan transaksi sebenar.
- Kempen baharu: tambah baris `kempens` (seeder + migrasi data, kerana seeder tidak berjalan semasa deploy).

## Fasa seterusnya (belum dibina)
- Panel admin (cadangan: Filament) untuk Farid/Suhaila/Mira kemas kini kempen, kaunter, Papan Impak dan semak permohonan.
- Muat naik gambar laporan impak, notifikasi permohonan baru (emel/WhatsApp).
