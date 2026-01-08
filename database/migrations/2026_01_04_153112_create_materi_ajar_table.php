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
        Schema::create('materi_ajar', function (Blueprint $table) {
            $table->id('id_ma');
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->text('deskripsi');
            $table->foreignId('id_bidang_keahlian')->nullable();
            $table->foreign('id_bidang_keahlian')->references('id_bidang_keahlian')->on('bidang_keahlian')->onDelete('cascade');
            $table->integer('semester');
            $table->integer('sks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_ajar');
    }
};
