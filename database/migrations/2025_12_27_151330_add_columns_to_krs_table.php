<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->string('nipd')->after('id');
            $table->string('kode_mk')->after('nipd');
            $table->unsignedBigInteger('dosen_id')->after('kode_mk');
            $table->unsignedBigInteger('kelas_id')->after('dosen_id');
            $table->string('jurusan')->after('kelas_id');
            $table->integer('sks')->after('jurusan'); // SKS milik KRS
            // Relasi
            $table->foreign('nipd')->references('nipd')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');

            $table->unique(['nipd','kode_mk']);
        });
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign(['nipd']);
            $table->dropForeign(['kode_mk']);
            $table->dropForeign(['dosen_id']);
            $table->dropForeign(['kelas_id']);
            $table->dropColumn(['nipd', 'kode_mk', 'dosen_id', 'kelas_id', 'jurusan', 'sks']);
        });
    }
};
