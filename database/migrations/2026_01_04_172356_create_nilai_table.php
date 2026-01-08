<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_pendidik');
            $table->foreignId('id_mahasiswa');
            $table->foreignId('id_ma');
            $table->integer('semester');
            $table->enum('periode', ['Ganjil', 'Genap']);
            $table->string('tahun_ajaran');
            $table->float('nilai_kehadiran');
            $table->float('nilai_sikap');
            $table->float('nilai_formative');
            $table->float('nilai_tugas');
            $table->float('nilai_uts');
            $table->float('nilai_uas');
            $table->float('nilai_akhir');
            $table->string('grade');
            $table->float('bobot_ip');
            $table->foreign('id_pendidik')->references('id_pendidik')->on('pendidik')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_ma')->references('id_ma')->on('materi_ajar')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
