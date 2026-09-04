<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('armadas', function (Blueprint $table) {
            // Satu-satunya kolom yang diedit dari menu "Ketersediaan Kursi".
            // Kursi tersedia & status ketersediaan dihitung otomatis dari kapasitas_seat - kursi_terbooking.
            $table->unsignedInteger('kursi_terbooking')->default(0)->after('kapasitas_seat');
        });
    }

    public function down(): void
    {
        Schema::table('armadas', function (Blueprint $table) {
            $table->dropColumn('kursi_terbooking');
        });
    }
};
