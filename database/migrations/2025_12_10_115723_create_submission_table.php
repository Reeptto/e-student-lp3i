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
        Schema::create('submission', function (Blueprint $table) {
            $table->id();
            $table->string('file_tugas_mhs');
            $table->unsignedBigInteger('mhs_id');
            $table->unsignedBigInteger('tugas_id');
            $table->float('nilai')->nullable();
            $table->enum('status', ['submitted', 'late', 'revised'])->default('submitted');
            $table->time('submitted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission');
    }
};
