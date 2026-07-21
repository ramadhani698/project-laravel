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
        Schema::create('ppdb_hasil_seleksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulir_pendaftaran_id')->unique()
                ->constrained('ppdb_formulir_pendaftarans')->cascadeOnDelete();
            $table->decimal('nilai_akademik', 5, 2)->nullable();
            $table->decimal('nilai_kejuruan', 5, 2)->nullable();
            $table->enum('status_kelulusan', ['menunggu', 'lulus', 'tidak_lulus'])
                ->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->date('tanggal_pengumuman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_hasil_seleksis');
    }
};
