<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beranda_settings', function (Blueprint $table) {
            $table->id();

            // --- Bagian Hero (banner hijau atas) ---
            $table->string('hero_badge_text');
            $table->string('hero_main_title');
            $table->string('hero_sub_title');
            $table->string('hero_academic_year');
            $table->string('hero_date_label');
            $table->string('hero_date_value');
            $table->string('hero_logo_sub');

            $table->string('instagram_url')->nullable();
            $table->string('instagram_handle')->nullable();
            $table->string('whatsapp_number')->nullable();

            // --- Bagian Welcome (teks sambutan) ---
            $table->string('welcome_heading');
            $table->longText('welcome_paragraph_1');
            $table->longText('welcome_paragraph_2');
            $table->longText('welcome_paragraph_3');

            // --- Alamat & kontak ---
            $table->text('address');
            $table->string('phone');
            $table->string('website_url')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beranda_settings');
    }
};