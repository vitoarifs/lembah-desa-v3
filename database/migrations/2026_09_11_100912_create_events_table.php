<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->date('tanggal');
            $table->string('waktu'); // Contoh: "06:00 - 11:00 WIB"
            $table->string('lokasi');
            $table->string('htm'); // Contoh: "Gratis" atau "Rp 75.000 / orang"
            $table->text('deskripsi');
            // $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};