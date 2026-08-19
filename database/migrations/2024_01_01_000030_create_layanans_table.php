<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            // kategori: bus, travel, pesawat, kapal, paket
            $table->string('kategori');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->decimal('harga', 12, 2)->nullable();
            $table->string('satuan_harga')->nullable(); // contoh: "per orang", "per kg"
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('unggulan')->default(false);
            $table->boolean('aktif')->default(true);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
