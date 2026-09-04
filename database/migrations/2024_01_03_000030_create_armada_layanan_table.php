<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('armada_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('armada_id')->constrained()->cascadeOnDelete();
            $table->foreignId('layanan_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['armada_id', 'layanan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armada_layanan');
    }
};
