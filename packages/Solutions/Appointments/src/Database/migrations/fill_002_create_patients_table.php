<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->string('phone',32);
            $table->string('email')->nullable();
            $table->enum('gender',['male','female','other'])->nullable();
            $table->date('birthdate')->nullable();
            $table->string('file_number')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->index(['phone','is_active']);
        });
    }
    public function down(): void { Schema::dropIfExists('patients'); }
};
