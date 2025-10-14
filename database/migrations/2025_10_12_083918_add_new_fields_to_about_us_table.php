<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            // Add new JSON fields for multilingual content
            $table->json('philosophy_quote')->nullable();
            $table->json('philosophy_author')->nullable();
            $table->json('core_values')->nullable();
            $table->json('treatment_techniques')->nullable();
            $table->json('comprehensive_care')->nullable();
            $table->json('patient_approach')->nullable();
            $table->json('education_degree')->nullable();
            $table->json('education_specialization')->nullable();
            $table->json('education_memberships')->nullable();

            // Add string field for experience years
            $table->string('experience_years')->nullable();

            // Optional: Add description fields
            $table->json('education_description')->nullable();
            $table->json('education_degree_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            // Remove the fields if rolling back
            $table->dropColumn([
                'philosophy_quote',
                'philosophy_author',
                'core_values',
                'treatment_techniques',
                'comprehensive_care',
                'patient_approach',
                'education_degree',
                'education_specialization',
                'education_memberships',
                'experience_years',
                'education_description',
                'education_degree_description'
            ]);
        });
    }
};
