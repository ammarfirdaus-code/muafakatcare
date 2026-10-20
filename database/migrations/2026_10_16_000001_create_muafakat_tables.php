<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('ikon', 16)->nullable();
            $t->string('nama');
            $t->string('satu_baris');
            $t->text('tldr');
            $t->json('apa_kami_buat')->nullable();
            $t->string('kos_seunit')->nullable();
            $t->json('isi_pek')->nullable();
            $t->json('faq')->nullable();
            $t->unsignedSmallInteger('susunan')->default(0);
            $t->timestamps();
        });

        Schema::create('kempens', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->foreignId('program_id')->nullable()->constrained()->nullOnDelete();
            $t->boolean('aktif')->default(true);
            $t->string('label')->nullable();
            $t->string('tajuk');
            $t->text('ringkas');
            $t->string('gambar')->nullable();
            $t->string('unit', 16)->default('RM');           // RM, pek, katil
            $t->unsignedInteger('sasaran')->nullable();
            $t->unsignedInteger('terkumpul')->nullable();     // mesti tally dengan bank + BCL
            $t->string('pautan_bcl')->nullable();             // null = belum disahkan
            $t->unsignedSmallInteger('susunan')->default(0);
            $t->timestamps();
        });

        Schema::create('laporan_impaks', function (Blueprint $t) {
            $t->id();
            $t->string('bulan', 7);                           // YYYY-MM
            $t->foreignId('program_id')->nullable()->constrained()->nullOnDelete();
            $t->boolean('terbit')->default(false);
            $t->string('tajuk');
            $t->string('lokasi')->nullable();                 // mukim sahaja, bukan alamat
            $t->date('tarikh_agihan')->nullable();
            $t->unsignedInteger('penerima')->nullable();
            $t->unsignedInteger('sasaran')->nullable();
            $t->decimal('kos', 10, 2)->nullable();
            $t->string('sumber_dana')->nullable();
            $t->text('nota')->nullable();
            $t->json('gambar')->nullable();                   // gambar berizin sahaja
            $t->timestamps();
            $t->unique(['bulan', 'program_id']);
        });

        Schema::create('kaunter_impaks', function (Blueprint $t) {
            $t->id();
            $t->string('label');
            $t->unsignedInteger('nilai')->nullable();         // null = belum disahkan Ammar
            $t->unsignedSmallInteger('susunan')->default(0);
            $t->timestamps();
        });

        Schema::create('soalan_lazims', function (Blueprint $t) {
            $t->id();
            $t->string('soalan');
            $t->text('jawapan');
            $t->unsignedSmallInteger('susunan')->default(0);
            $t->timestamps();
        });

        // Data peribadi (PDPA): hanya pasukan berkenaan. Jangan eksport ke log/slide.
        Schema::create('permohonan_bantuans', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('telefon', 20);
            $t->string('kawasan');
            $t->string('jenis');
            $t->unsignedSmallInteger('tanggungan')->nullable();
            $t->text('keterangan')->nullable();
            $t->string('status')->default('baru');            // baru, disemak, dibantu, ditolak
            $t->timestamps();
        });

        Schema::create('sukarelawans', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('telefon', 20);
            $t->text('minat')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['sukarelawans', 'permohonan_bantuans', 'soalan_lazims', 'kaunter_impaks', 'laporan_impaks', 'kempens', 'programs'] as $t) {
            Schema::dropIfExists($t);
        }
    }
};
