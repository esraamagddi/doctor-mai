<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            if (!Schema::hasColumn('about_us', 'vision_image')) {
                $table->string('vision_image')->nullable()->after('image');
            }
            if (!Schema::hasColumn('about_us', 'goal_image')) {
                $table->string('goal_image')->nullable()->after('vision_image');
            }
            if (!Schema::hasColumn('about_us', 'stats_image')) {
                $table->string('stats_image')->nullable()->after('goal_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
           $table->dropColumn([
                'vision_image',
                'goal_image',
                'stats_image',
            ]);
        });
    }
};
