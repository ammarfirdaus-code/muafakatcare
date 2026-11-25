<?php

use App\Models\Program;
use Database\Seeders\LaporanTelegramSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Isi laporan lama (Telegram, termasuk bantuan Palestin) dan gambarnya pada pemasangan sedia ada,
     * supaya deploy tidak bergantung pada arahan seeder manual. Pemasangan baharu guna `db:seed`.
     */
    public function up(): void
    {
        if (! Schema::hasTable('programs') || Program::count() === 0) {
            return;
        }

        try {
            (new LaporanTelegramSeeder)->run();
        } catch (\Throwable $e) {
            report($e); // jangan gagalkan deploy; semak storage/logs jika laporan tidak muncul
        }
    }

    public function down(): void
    {
        // Data kekal; tiada apa untuk dibuang.
    }
};
