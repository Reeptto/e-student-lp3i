<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->integer('nipd');              // Nomor mhs
            $table->integer('nidn');              // Nomor cosen
            $table->string('nama_mhs');           // Nama mhs
            $table->float('nilai_kehadiran')->nullable();
            $table->float('nilai_attitude')->nullable();
            $table->float('nilai_formatif')->nullable();
            $table->float('nilai_tugas')->nullable();   // <-- tambahan
            $table->float('nilai_uts')->nullable();
            $table->float('nilai_uas')->nullable();
            $table->float('ip_semester')->nullable();
            $table->float('ip_kumulatif')->nullable();
            $table->string('huruf_mutu')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};