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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->float('nilai_tugas');
            $table->float('nilai_formative');
            $table->float('nilai_uts');
            $table->float('nilai_uas');
            $table->float('nilai_kumulatif');
            $table->string('huruf_mutu');
            $table->unsignedBigInteger('mhs_id');
            $table->unsignedBigInteger('mk_id');
            $table->string('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
