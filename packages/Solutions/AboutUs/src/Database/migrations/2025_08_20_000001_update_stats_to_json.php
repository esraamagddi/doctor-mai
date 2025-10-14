<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {            
            // Add missing stats columns as JSON if they don't exist
            if (!Schema::hasColumn('about_us', 'stat1_title')) {
                $table->json('stat1_title')->nullable();
            }
            if (!Schema::hasColumn('about_us', 'stat1_value')) {
                $table->json('stat1_value')->nullable();
            }
            if (!Schema::hasColumn('about_us', 'stat1_description')) {
                $table->json('stat1_description')->nullable();
            }
            if (!Schema::hasColumn('about_us', 'stat2_title')) {
                $table->json('stat2_title')->nullable();
            }
            if (!Schema::hasColumn('about_us', 'stat2_value')) {
                $table->json('stat2_value')->nullable();
            }
            if (!Schema::hasColumn('about_us', 'stat2_description')) {
                $table->json('stat2_description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn([
                'stat1_title',
                'stat1_value',
                'stat1_description',
                'stat2_title',
                'stat2_value',
                'stat2_description'
            ]);
        });
    }
};