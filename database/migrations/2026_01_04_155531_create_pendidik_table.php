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
        Schema::create('pendidik', function (Blueprint $table) {
            $table->id('id_pendidik');
            $table->string('nama');
            $table->string('pendidikan');
            $table->string('bidang');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'perempuan']);
            $table->string('agama');
            $table->string('email')->unique();
            $table->string('no_tlp');
            $table->float('rate_gaji');
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Kontrak', 'Tetap', 'Honorer'])->default('Aktif');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidik');
    }
};
