<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Teks slaid hero laman utama. Kosong = guna label + tajuk kempen.
        Schema::table('kempens', function (Blueprint $t) {
            $t->string('hero_sorotan', 40)->nullable()->after('ringkas');   // frasa dalam kotak putih, cth "RM50"
            $t->string('hero_ayat')->nullable()->after('hero_sorotan');     // sambungan ayat tajuk
        });
    }

    public function down(): void
    {
        Schema::table('kempens', function (Blueprint $t) {
            $t->dropColumn(['hero_sorotan', 'hero_ayat']);
        });
    }
};
