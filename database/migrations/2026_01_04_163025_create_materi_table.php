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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->foreignId('id_ma');
            $table->foreignId('id_kelas');
            $table->string('judul_materi');
            $table->string('file_materi')->nullable();
            $table->text('deskripsi');
            $table->string('pertemuan');
            $table->date('tgl_upload');
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
        Schema::dropIfExists('materi');
    }
};
