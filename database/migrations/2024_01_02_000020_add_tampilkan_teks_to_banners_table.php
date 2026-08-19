<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            // Matikan kalau gambar sudah memuat teks/desain lengkap sendiri (poster jadi).
            $table->boolean('tampilkan_teks')->default(true)->after('link_url');
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('tampilkan_teks');
        });
    }
};
