<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('site_name');
            $table->json('site_description')->nullable();
            $table->json('address')->nullable();
            $table->string('logo_light')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();
            $table->json('social')->nullable();
            $table->string('ga4_id')->nullable();
            $table->string('gtm_id')->nullable();
            $table->string('fb_pixel_id')->nullable();
            $table->longText('custom_head')->nullable();
            $table->longText('custom_body')->nullable();
            $table->json('contact_emails')->nullable();
            $table->json('contact_phones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
