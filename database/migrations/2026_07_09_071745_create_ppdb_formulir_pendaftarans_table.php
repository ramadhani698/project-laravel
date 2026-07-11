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
        Schema::create('ppdb_formulir_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_pendaftar_id')->constrained('ppdb_pendaftars')->cascadeOnDelete();

            // Nomor pendaftaran resmi — diisi saat submit final, bukan saat draft
            $table->string('no_pendaftaran', 6)->nullable()->unique();

            // Biodata
            $table->string('nisn', 10)->nullable();
            $table->string('nik', 16)->nullable();       // NIK siswa (sesuai KK)
            $table->string('no_kk', 16)->nullable();      // Nomor Kartu Keluarga
            $table->string('no_akta')->nullable();        // Nomor Akta Kelahiran
            $table->string('nama_lengkap')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('asal_sekolah')->nullable();

            // Keluarga
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah', 16)->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu', 16)->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ortu', 20)->nullable();

            // Jurusan
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->nullOnDelete();

            // Progress tracking
            $table->unsignedTinyInteger('current_step')->default(1);
            $table->enum('status', ['draft', 'menunggu_verifikasi', 'terverifikasi'])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_formulir_pendaftarans');
    }
};
