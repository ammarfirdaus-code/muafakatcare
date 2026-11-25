<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Gambar jubin program di laman utama (berizin sahaja). Kosong = jubin kos.
        Schema::table('programs', function (Blueprint $t) {
            $t->string('gambar')->nullable()->after('ikon');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $t) {
            $t->dropColumn('gambar');
        });
    }
};
