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
            // Education & Qualifications fields
            if (!Schema::hasColumn('about_us', 'education_description')) {
                $table->json('education_description')->nullable()->after('stat2_description');
            }
            if (!Schema::hasColumn('about_us', 'education_degree')) {
                $table->json('education_degree')->nullable()->after('education_description');
            }
            if (!Schema::hasColumn('about_us', 'education_degree_description')) {
                $table->json('education_degree_description')->nullable()->after('education_degree');
            }
            
            // Experience & Philosophy fields
            if (!Schema::hasColumn('about_us', 'experience_years')) {
                $table->integer('experience_years')->nullable()->after('education_degree_description');
            }
            if (!Schema::hasColumn('about_us', 'treatment_techniques')) {
                $table->json('treatment_techniques')->nullable()->after('experience_years');
            }
            if (!Schema::hasColumn('about_us', 'philosophy_quote')) {
                $table->json('philosophy_quote')->nullable()->after('treatment_techniques');
            }
            if (!Schema::hasColumn('about_us', 'philosophy_author')) {
                $table->json('philosophy_author')->nullable()->after('philosophy_quote');
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
                'education_description',
                'education_degree',
                'education_degree_description',
                'experience_years',
                'treatment_techniques',
                'philosophy_quote',
                'philosophy_author',
            ]);
        });
    }
};