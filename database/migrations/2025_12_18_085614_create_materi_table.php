<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            
            // Kolom penghubung (Foreign Key) tipe String
            $table->string('kode_mk'); 

            // Definisikan Relasi ke tabel matakuliah
            $table->foreign('kode_mk')
                  ->references('kode_mk')
                  ->on('matakuliah')
                  ->onDelete('cascade');
            
            $table->string('nama_materi');
            $table->string('file_materi'); 
            $table->text('deskripsi')->nullable(); 
            $table->string('pertemuan'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};