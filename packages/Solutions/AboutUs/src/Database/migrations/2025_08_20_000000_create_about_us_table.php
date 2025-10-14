<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // الحقول متعددة اللغات
            $table->json('title');
            $table->json('sub_title')->nullable();
            $table->json('mission')->nullable();
            $table->json('vision')->nullable();
            $table->json('values')->nullable();
            $table->json('goals')->nullable();
            $table->json('history')->nullable();

            // الصور والفيديو
            $table->string('image')->nullable();
            $table->string('vision_image')->nullable();
            $table->string('goal_image')->nullable();
            $table->string('stats_image')->nullable();
            $table->string('video_url')->nullable();

            // وسائل التواصل والبريد والهاتف
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();

            // الإحصائيات
            $table->string('stat1_title')->nullable();
            $table->string('stat1_value')->nullable();
            $table->text('stat1_description')->nullable();
            $table->string('stat2_title')->nullable();
            $table->string('stat2_value')->nullable();
            $table->text('stat2_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
