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
            $table->id('id_tugas');
            $table->string('judul_tugas');
            $table->string('file_materi')->nullable();
            $table->text('deskripsi');
            $table->dateTime('jam_mulai');
            $table->dateTime('jam_selesai');
            $table->enum('status', ['Aktif', 'Nonaktif']);
            $table->foreignId('id_ma');
            $table->foreignId('id_kelas');
            $table->foreign('id_ma')->references('id_ma')->on('materi_ajar')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
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
