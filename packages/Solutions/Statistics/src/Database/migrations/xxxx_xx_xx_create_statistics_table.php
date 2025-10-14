<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('short_description')->nullable();
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('statistics_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('statistics_id')->constrained('statistics')->onDelete('cascade');
            $table->integer('number')->default(0);
            $table->json('short_description')->nullable();
            $table->json('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistics_details');
        Schema::dropIfExists('statistics');
    }
};
