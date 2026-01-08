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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nipd')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('domisili');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('angkatan');
            $table->string('periode');
            $table->string('email')->unique();
            $table->string('agama');
            $table->string('no_tlp');
            $table->string('foto')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreignId('id_bidang_keahlian');
            $table->foreign('id_bidang_keahlian')->references('id_bidang_keahlian')->on('bidang_keahlian')->onDelete('cascade');
            $table->foreignId('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
