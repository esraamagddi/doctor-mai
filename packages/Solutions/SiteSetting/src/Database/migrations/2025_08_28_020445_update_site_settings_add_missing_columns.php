<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('site_settings', 'site_tagline')) {
                $table->json('site_tagline')->nullable()->after('site_name');
            }
            if (!Schema::hasColumn('site_settings', 'order')) {
                $table->integer('order')->default(0)->after('custom_body');
            }
            if (!Schema::hasColumn('site_settings', 'status')) {
                $table->boolean('status')->default(true)->after('order');
            }
            if (!Schema::hasColumn('site_settings', 'working_hours')) {
                $table->json('working_hours')->nullable()->after('status');
            }
            if (!Schema::hasColumn('site_settings', 'google_map_embed')) {
                $table->longText('google_map_embed')->nullable()->after('working_hours');
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            if (Schema::hasColumn('site_settings', 'google_map_embed')) {
                $table->dropColumn('google_map_embed');
            }
            if (Schema::hasColumn('site_settings', 'working_hours')) {
                $table->dropColumn('working_hours');
            }
            if (Schema::hasColumn('site_settings', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('site_settings', 'order')) {
                $table->dropColumn('order');
            }
            if (Schema::hasColumn('site_settings', 'site_tagline')) {
                $table->dropColumn('site_tagline');
            }
        });
    }
};
