<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('subject')->nullable();
            $table->longText('message');

    
            $table->json('meta')->nullable();
            $table->json('attachments')->nullable();

      
            $table->boolean('is_read')->default(false);
            $table->unsignedTinyInteger('status')->default(0); 

            $table->timestamps();

         
            $table->index(['status', 'is_read', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
