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
        Schema::create('ppdb_jawaban_pendaftars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulir_pendaftaran_id')
                ->constrained('ppdb_formulir_pendaftarans')->cascadeOnDelete();
            $table->foreignId('soal_tes_id')
                ->constrained('ppdb_soal_tes')->cascadeOnDelete();
            $table->char('jawaban_dipilih', 1)->nullable();
            $table->timestamps();

            $table->unique(['formulir_pendaftaran_id', 'soal_tes_id'], 'jawaban_pendaftar_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_jawaban_pendaftars');
    }
};
