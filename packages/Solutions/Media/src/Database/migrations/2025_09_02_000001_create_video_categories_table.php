<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name');
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index(['status','order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_categories');
    }
};
