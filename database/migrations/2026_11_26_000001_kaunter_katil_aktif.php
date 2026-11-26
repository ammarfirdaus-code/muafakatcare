<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Catatan kecil di bawah kaunter, cth. tarikh angka itu disahkan.
        Schema::table('kaunter_impaks', function (Blueprint $t) {
            $t->string('catatan')->nullable()->after('nilai');
        });

        // Pemasangan sedia ada: kaunter katil ditukar kepada pengguna aktif.
        // Sumber: hebahan rasmi 11 Sep 2026 (t.me/muafakatcare/3308), "kesemua 13 katil sedang digunakan".
        DB::table('kaunter_impaks')->where('label', 'Katil hospital disalurkan')->update([
            'label' => 'Pengguna katil hospital aktif', 'nilai' => 13,
            'catatan' => 'Setakat 11 September 2026', 'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('kaunter_impaks')->where('label', 'Pengguna katil hospital aktif')->update([
            'label' => 'Katil hospital disalurkan', 'nilai' => null,
        ]);
        Schema::table('kaunter_impaks', function (Blueprint $t) {
            $t->dropColumn('catatan');
        });
    }
};
