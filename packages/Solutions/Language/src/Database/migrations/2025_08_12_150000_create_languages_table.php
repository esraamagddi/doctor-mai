<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 10)->unique(); // ar, en, fr, ar-EG
            $table->enum('dir', ['ltr','rtl'])->default('ltr');
            $table->string('locale', 20)->nullable(); // en_US, ar_EG
            $table->unsignedInteger('order')->default(0);
            $table->boolean('status')->default(true); // active/inactive
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('languages');
    }
};
