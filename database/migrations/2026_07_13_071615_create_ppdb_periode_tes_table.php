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
        Schema::create('ppdb_periode_tes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode');
            $table->date('tanggal_buka_tes');
            $table->date('tanggal_tutup_tes');
            $table->boolean('is_aktif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_periode_tes');
    }
};
