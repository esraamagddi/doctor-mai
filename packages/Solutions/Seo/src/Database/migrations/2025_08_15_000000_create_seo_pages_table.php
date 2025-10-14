<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('meta_title');
            $table->json('meta_description')->nullable();
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('slug')->unique();
            $table->string('canonical')->nullable();
            $table->string('og_image')->nullable();
            $table->boolean('robots_index')->default(true);
            $table->boolean('robots_follow')->default(true);
            $table->json('robots_extra')->nullable();
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('schema_type')->default('webpage');
            $table->json('schema_json')->nullable();
            $table->json('hreflang')->nullable();
            $table->string('changefreq')->nullable();
            $table->decimal('priority', 2, 1)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('seo_pages', function (Blueprint $table) {
            $table->index(['status', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
    }
};
