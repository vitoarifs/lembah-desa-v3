<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_identities', function (Blueprint $table) {
            $table->id();
            
            // Informasi Utama
            $table->string('nama_website');
            $table->string('tagline')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            
            // Asset Gambar
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            
            // Kontak & Operasional
            $table->string('nomor_whatsapp');
            $table->string('email');
            $table->json('jam_operasional')->nullable();
            $table->text('alamat');
            $table->text('link_gmaps')->nullable();
            
            // Media Sosial
            $table->string('link_instagram')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_youtube')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_identities');
    }
};