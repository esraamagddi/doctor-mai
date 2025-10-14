<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->date('preferred_date');
            $table->time('preferred_time')->nullable();
            $table->enum('status',['pending','confirmed','completed','canceled','no_show'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['preferred_date','status','service_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('appointments'); }
};
