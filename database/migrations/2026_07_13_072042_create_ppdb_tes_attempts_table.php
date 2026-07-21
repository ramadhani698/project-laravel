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
        Schema::create('ppdb_tes_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulir_pendaftaran_id')->unique()
                ->constrained('ppdb_formulir_pendaftarans')->cascadeOnDelete();
            $table->foreignId('periode_tes_id')->nullable()
                ->constrained('ppdb_periode_tes')->nullOnDelete();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai_mengerjakan')->nullable();
            $table->enum('status', ['belum_mulai', 'sedang_mengerjakan', 'selesai'])
                ->default('belum_mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_tes_attempts');
    }
};
