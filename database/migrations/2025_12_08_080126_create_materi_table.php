<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->string('judul_materi');
            $table->text('deskripsi')->nullable();
            $table->string('file_materi')->nullable();
            $table->dateTime('tanggal_upload');
            $table->integer('pertemuan');
            // Relasi
            $table->unsignedBigInteger('nidn');      // ke tabel dosen
            $table->string('kode_mk');               // ke tabel mata kuliah
            $table->unsignedBigInteger('id_kelas');  // ke tabel kelas

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
