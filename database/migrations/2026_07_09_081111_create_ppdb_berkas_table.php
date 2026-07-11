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
        Schema::create('ppdb_berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_pendaftar_id')->constrained('ppdb_pendaftars')->cascadeOnDelete();
            $table->enum('jenis_dokumen', [
                'ktp_ortu',
                'akta_kelahiran',
                'kartu_keluarga',
                'ijazah',
                'skl',
                'rapor_semester_akhir',
                'surat_keterangan_sehat',
            ]);
            $table->string('nama_asli');
            $table->string('file_path');
            $table->unsignedInteger('ukuran'); // bytes
            $table->enum('status_verifikasi', ['menunggu', 'valid', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->unique(['ppdb_pendaftar_id', 'jenis_dokumen']); // 1 dokumen per jenis, re-upload = replace
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_berkas');
    }
};
