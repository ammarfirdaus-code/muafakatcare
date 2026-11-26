<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Bilangan disahkan Ammar pada 26 Nov 2026: 15 katil.
    public function up(): void
    {
        DB::table('kaunter_impaks')->where('label', 'Pengguna katil hospital aktif')->update([
            'nilai' => 15, 'catatan' => 'Setakat 26 November 2026', 'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('kaunter_impaks')->where('label', 'Pengguna katil hospital aktif')->update([
            'nilai' => 13, 'catatan' => 'Setakat 11 September 2026',
        ]);
    }
};
