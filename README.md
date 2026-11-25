# Website Muafakat Care (Laravel + Forge)
Disediakan 2026-10-16 | Ammar > Kamil > Roy > Ilham | Status: DRAF setup kod. Tiada deploy tanpa "lulus" Ammar.
Domain: **muafakatcare.com** · Rujukan susunan: `../01_PELAN/2026-10-01_RangkaWebsite-MuafakatCare_v1.md` (gaya Cinta Gaza Malaysia).

## Apa yang dah ada
- 14 halaman awam: Utama, Program (4), Papan Impak + laporan bulanan, Cara Infak, Tentang, Soalan Lazim, Laporan, Mohon Bantuan, Sukarelawan, Hubungi, Privasi, `sitemap.xml`.
- Pangkalan data: program, kempen (sasaran/terkumpul/pautan BCL), laporan impak bulanan (terbit/draf), kaunter impak, FAQ, permohonan bantuan, sukarelawan.
- Borang Mohon Bantuan & Sukarelawan disimpan dalam DB: validasi, persetujuan PDPA, honeypot spam, had 5 hantaran/minit.
- SEO/GEO: meta BM, schema `NGO` + `FAQPage`, `sitemap.xml`, `robots.txt`, `llms.txt`.
- Pautan BCL sebenar: infak-foodbank, infak-subuh, infak-jumaat. Wakaf Katil: belum disahkan (butang disembunyikan).
- 6 ujian automatik (`php artisan test`), semua lulus.

## Jalankan di komputer (di LUAR Google Drive)
```
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # Windows: type nul > database\database.sqlite
php artisan migrate --seed
php artisan serve                   # buka http://localhost:8000
```

## Deploy ke Laravel Forge
1. Push folder ini ke repo GitHub baru (cth. `ammarfirdaus-code/muafakatcare`). `.env`, `vendor/` dan `database.sqlite` tidak ikut (dah dalam `.gitignore`).
2. Forge > server (PHP 8.3+) > **New Site** `muafakatcare.com` (+ alias `www.muafakatcare.com`) > sambung repo, branch `main`.
3. Forge cipta DB MySQL. Dalam **Environment**: `APP_URL=https://muafakatcare.com`, `APP_ENV=production`, `APP_DEBUG=false`, DB_*, dan MC_WHATSAPP / MC_EMEL / MC_ALAMAT / MC_FACEBOOK / MC_INSTAGRAM / MC_TIKTOK / MC_TELEGRAM (pautan medsos ada nilai lalai dalam config/muafakat.php).
4. DNS di pendaftar domain: rekod **A** `@` dan `www` ke IP server Forge.
5. Forge > SSL > Let's Encrypt.
6. Deploy kali pertama, kemudian sekali sahaja di Forge > Commands: `php artisan db:seed --class=KandunganAwalSeeder --force`
7. Skrip deploy default Forge sudah cukup (composer install, migrate --force).

## Kemas kini kandungan (sementara, sebelum panel admin)
Ubah `database/seeders/KandunganAwalSeeder.php` atau terus dalam DB, kemudian jalankan seeder semula. Panel admin (Filament) ialah fasa seterusnya.

## Belum ada (Ammar beri bila sedia)
- [ ] Angka impak rasmi (pek, katil, keluarga, tahun mula)
- [ ] WhatsApp, emel, alamat, pautan FB/IG/TikTok
- [ ] Pautan BCL Wakaf Katil
- [ ] Gambar agihan berizin
- [ ] Kisah penubuhan + AJK yang setuju dipapar
- [ ] Semak teks Notis Privasi
