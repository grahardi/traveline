<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('site_settings', 'maps_url')) {
            DB::statement('ALTER TABLE site_settings ALTER COLUMN maps_url TYPE TEXT');
        }
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE site_settings ALTER COLUMN maps_url TYPE VARCHAR(255)');
    }
};
