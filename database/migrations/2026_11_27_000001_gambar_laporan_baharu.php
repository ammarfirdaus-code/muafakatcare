<?php

use App\Models\Program;
use Database\Seeders\LaporanTelegramSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Pasang ilustrasi laporan baharu (public/img/ilustrasi) pada pemasangan sedia ada. */
    public function up(): void
    {
        if (! Schema::hasTable('programs') || Program::count() === 0) {
            return;
        }

        try {
            (new LaporanTelegramSeeder)->run();
        } catch (\Throwable $e) {
            report($e);
        }
    }

    public function down(): void
    {
        //
    }
};
