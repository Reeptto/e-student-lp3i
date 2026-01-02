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
        Schema::table('mahasiswa', function (Blueprint $table) {
            
        $table->foreignId('bidang_keahlian_id')
      ->constrained('bidang_keahlian')->after('tanggal_lahir');

            $table->string('angkatan')->after('bidang_keahlian_id');
            $table->string('periode')->after('angkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
