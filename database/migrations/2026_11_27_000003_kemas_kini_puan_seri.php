<?php

use App\Models\Kempen;
use Database\Seeders\KandunganAwalSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /** Gambar sebenar dan jumlah terkumpul (BCL, setakat 27 Nov 2026) untuk kempen Puan Seri. */
    public function up(): void
    {
        Kempen::where('slug', 'bantu-puan-seri')->update([
            'gambar' => KandunganAwalSeeder::PUAN_SERI['gambar'],
            'terkumpul' => KandunganAwalSeeder::PUAN_SERI['terkumpul'],
        ]);
    }

    public function down(): void
    {
        Kempen::where('slug', 'bantu-puan-seri')->update(['terkumpul' => null]);
    }
};
