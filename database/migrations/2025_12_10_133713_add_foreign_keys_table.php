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
        // relasi jurusan dan kelas terhadap mahasiswa 
        Schema::table('mahasiswa', function (Blueprint $table) {
            // $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            
        });

        // relasi jurusan terhadap kelas
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
        });

        // relasi mk, dsn, ruangan untuk create jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('mk_id')->references('id')->on('matakuliah')->onDelete('cascade');
            $table->foreign('dsn_id')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangan')->onDelete('cascade');
        });

        // relasi kelas, mk, dsn untuk create tugas
        Schema::table('tugas', function (Blueprint $table) {
            $table->foreign('dsn_id')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('mk_id')->references('id')->on('matakuliah')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });

        // relasi mhs, tugas untuk create submission 
        Schema::table('submission', function (Blueprint $table) {
            $table->foreign('mhs_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
        });

        // relasi nilai ke mhs dan mk
        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('mhs_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('mk_id')->references('id')->on('matakuliah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    // mahasiswa
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->dropForeign(['jurusan_id']);
        $table->dropForeign(['kelas_id']);
    });

    // kelas
    Schema::table('kelas', function (Blueprint $table) {
        $table->dropForeign(['jurusan_id']);
    });

    // jadwal
    Schema::table('jadwal', function (Blueprint $table) {
        $table->dropForeign(['mk_id']);
        $table->dropForeign(['dsn_id']);
        $table->dropForeign(['ruang_id']);
    });

    // tugas
    Schema::table('tugas', function (Blueprint $table) {
        $table->dropForeign(['dsn_id']);
        $table->dropForeign(['mk_id']);
        $table->dropForeign(['kelas_id']);
    });

    // submission
    Schema::table('submission', function (Blueprint $table) {
        $table->dropForeign(['mhs_id']);
        $table->dropForeign(['tugas_id']);
    });

    // nilai
    Schema::table('nilai', function (Blueprint $table) {
        $table->dropForeign(['mhs_id']);
        $table->dropForeign(['mk_id']);
    });
}
};
