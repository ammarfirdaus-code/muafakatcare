<?php

use App\Models\Kempen;
use App\Models\Program;
use Database\Seeders\KandunganAwalSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Tambah kempen Bantu Penjagaan Puan Seri di hadapan pada pemasangan sedia ada. */
    public function up(): void
    {
        if (! Schema::hasTable('programs') || Program::count() === 0) {
            return;
        }

        foreach (['foodbank' => 1, 'wakaf-katil' => 2, 'tabung-banjir' => 3, 'infak-subuh' => 4, 'infak-jumaat' => 5] as $slug => $susunan) {
            Kempen::where('slug', $slug)->update(['susunan' => $susunan]);
        }
        Kempen::updateOrCreate(['slug' => 'bantu-puan-seri'], KandunganAwalSeeder::PUAN_SERI + [
            'program_id' => Program::where('slug', 'bantuan')->value('id'),
        ]);
    }

    public function down(): void
    {
        Kempen::where('slug', 'bantu-puan-seri')->delete();
    }
};
