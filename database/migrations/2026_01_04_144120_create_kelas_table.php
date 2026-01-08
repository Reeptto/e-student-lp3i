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
            Schema::create('kelas', function (Blueprint $table) {
                $table->id('id_kelas');
                $table->string('nama_kelas');
                $table->foreignId('id_bidang_keahlian');
                $table->foreign('id_bidang_keahlian')->references('id_bidang_keahlian')->on('bidang_keahlian')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('kelas');
        }
    };
