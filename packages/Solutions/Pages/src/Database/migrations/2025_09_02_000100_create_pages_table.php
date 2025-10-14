<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug', 191)->unique();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index(['status','order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
