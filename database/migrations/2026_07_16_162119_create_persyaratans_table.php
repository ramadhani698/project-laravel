<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persyaratans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->text('keterangan')->nullable();
            $table->boolean('wajib')->default(false);
            $table->json('format_diizinkan')->nullable();
            $table->integer('maksimal_ukuran_kb')->default(2048);
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persyaratans');
    }
};