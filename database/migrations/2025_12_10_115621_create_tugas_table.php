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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tugas');
            $table->string('file_materi');
            $table->string('deskripsi');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->enum('status', ['Belum Selesai', 'Selesai', 'Terlambat Selesai'])->default('Belum Selesai');
            $table->unsignedBigInteger('dsn_id');
            $table->unsignedBigInteger('mk_id');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
