<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_lkm', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->unsignedBigInteger('nipd');         // NIM/NIPD mahasiswa
            $table->unsignedBigInteger('nidn');         // NIM/NIPD mahasiswa
            $table->string('kode_mk');                  // mata kuliah
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha']);                 // hadir / izin / sakit
            $table->time('jam_masuk')->nullable();
            $table->unsignedBigInteger('id_kelas');
            $table->string('materi')->nullable();
            $table->text('catatan')->nullable();
            $table->string('metode_mengajar')->nullable();
            $table->unsignedBigInteger('nidn');         // dosen pengajar
            $table->string('pertemuan')->nullable();
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_lkm');
    }
};
