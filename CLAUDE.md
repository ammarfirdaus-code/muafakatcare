# Muafakat Care Website — nota untuk ejen (Ilham)

Laravel 13 (PHP 8.3+), Blade, CSS biasa di `public/css/app.css` (tiada Vite/npm). Deploy: Laravel Forge, domain muafakatcare.com.

## Peraturan
- Bahasa paparan: Bahasa Melayu. Ikut jenama `02_MUAFAKAT-CARE/_BRAND/2026-10-01_DESIGN-MuafakatCare_v2.md` (token warna di `:root` app.css).
- JANGAN reka angka impak. Medan `null` dipapar "akan dikemas kini". Angka kempen mesti tally dengan bank + BCL.
- Maruah penerima: tiada nama penuh, alamat, IC dalam laporan impak. Gambar berizin sahaja; wajah kanak-kanak dikaburkan.
- `permohonan_bantuans` & `sukarelawans` = data peribadi (PDPA). Jangan salin ke log, seeder, slide atau chat.
- Tiada deploy/push ke main tanpa "lulus" Ammar. Jalankan `php artisan test` sebelum PR.

## Struktur
- Maklumat organisasi: `config/muafakat.php` (+ `.env` MC_*).
- Kandungan: jadual `programs`, `kempens`, `laporan_impaks`, `kaunter_impaks`, `soalan_lazims`. Data awal: `database/seeders/KandunganAwalSeeder.php` (selamat diulang).
- Halaman: `app/Http/Controllers/HalamanController.php`, borang: `BorangController.php`, laluan: `routes/web.php`, paparan: `resources/views/`.
- Ujian: `tests/Feature/HalamanTest.php`.

## Fasa seterusnya (belum dibina)
- Panel admin (cadangan: Filament) untuk Farid/Suhaila/Mira kemas kini kempen, kaunter, Papan Impak dan semak permohonan.
- Muat naik gambar laporan impak, notifikasi permohonan baru (emel/WhatsApp).
