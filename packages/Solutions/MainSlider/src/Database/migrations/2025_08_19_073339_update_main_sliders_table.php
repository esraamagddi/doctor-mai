<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('main_sliders', function (Blueprint $table) {
            $table->dropColumn(['mobile_image', 'extra_settings', 'button_text', 'button_link', 'button_target']);

            $table->string('background_image')->nullable();
            $table->string('video')->nullable();
            $table->json('button1_text')->nullable();
            $table->string('button1_link')->nullable();
            $table->json('button2_text')->nullable();
            $table->string('button2_link')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('main_sliders', function (Blueprint $table) {
            $table->string('mobile_image')->nullable();
            $table->json('extra_settings')->nullable();
            $table->json('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('button_target')->nullable();

            $table->dropColumn(['background_image', 'video', 'button1_text', 'button1_link', 'button2_text', 'button2_link']);
        });
    }
};
