# Penjana eBook percuma

Skrip ini menghasilkan 10 PDF di `public/ebook` dan kulitnya di `public/img/ebook`.

- Kandungan: `isi_a.py`, `isi_b.py`, `isi_c.py`. Reka letak dan gaya: `lib.py`.
- Teks Al-Quran dan terjemahan Basmeih ditarik daripada api.alquran.cloud.
- Teks Arab hadis diambil daripada himpunan fawazahmed0/hadith-api. Muat turun `ara-<kitab>.min.json` dan `eng-<kitab>.min.json` (bukhari, muslim, tirmidhi, abudawud, ibnmajah, nasai) ke folder ini sebagai `ara-<kitab>.json` dan `eng-<kitab>.json` sebelum menjana.
- Terjemahan hadis ditulis oleh penyusun dan perlu disemak oleh ustaz.
- Seni kulit di `seni/` dijana dengan Codex (penjana imej ChatGPT); tajuk diletakkan oleh `lib.py`.

Jana: `python3 bina_semua.py`, kemudian `node render.js "$PWD/out" <slug...>` (perlukan Playwright), dan gabungkan `tmp/<slug>-kulit.pdf` dengan `tmp/<slug>-isi.pdf` menggunakan `pdfunite`. Laluan logo dalam `lib.py` (`LOGO`) perlu disesuaikan dengan lokasi repo.
