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
        Schema::create('ppdb_soal_tes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')->nullable()
                ->constrained('jurusans')->nullOnDelete();
            $table->enum('tipe_soal', ['akademik', 'kejuruan']);
            $table->text('pertanyaan');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->enum('kunci_jawaban', ['a', 'b', 'c', 'd']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_soal_tes');
    }
};
