<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pautan ke hebahan asal (cth. pos Telegram rasmi) sebagai bukti laporan.
        Schema::table('laporan_impaks', function (Blueprint $t) {
            $t->string('sumber_url')->nullable()->after('nota');
        });
    }

    public function down(): void
    {
        Schema::table('laporan_impaks', function (Blueprint $t) {
            $t->dropColumn('sumber_url');
        });
    }
};
