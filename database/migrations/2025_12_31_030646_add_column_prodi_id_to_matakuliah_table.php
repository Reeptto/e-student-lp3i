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
    Schema::table('matakuliah', function (Blueprint $table) {

        // tambahin kolom dulu
        if (!Schema::hasColumn('matakuliah', 'bidang_keahlian_id')) {
            $table->foreignId('bidang_keahlian_id')
                  ->after('id') // bebas posisinya
                  ->constrained('bidang_keahlian')
                  ->cascadeOnDelete();
        }
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matakuliah', function (Blueprint $table) {
            //
        });
    }
};
