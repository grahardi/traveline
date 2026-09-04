<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('foto_utama')->nullable();
            $table->text('deskripsi')->nullable();
            $table->json('fitur_utama')->nullable();   // contoh: ["AC", "TV", "Reclining Seat"]
            $table->json('fitur_lainnya')->nullable();  // contoh: ["Bantal & Selimut", "Toilet", "Snack"]
            $table->unsignedInteger('kapasitas_seat')->nullable();
            $table->unsignedInteger('seat_tersedia')->nullable();
            // status_ketersediaan: tersedia, terbatas, penuh — diupdate manual oleh admin
            $table->string('status_ketersediaan')->default('tersedia');
            $table->boolean('aktif')->default(true);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armadas');
    }
};
