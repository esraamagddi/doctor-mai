<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('main_sliders', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('link')->nullable();
            $table->json('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('button_target')->nullable();
            $table->string('overlay_color')->nullable();
            $table->decimal('overlay_opacity', 3, 2)->default(0.5);
            $table->json('extra_settings')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('main_sliders');
    }
};
