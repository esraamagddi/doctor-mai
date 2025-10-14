<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('founders', function (Blueprint $table) {
            // تحويل كل الحقول النصية لدعم تخزين JSON متعدد اللغات
            $table->json('position')->nullable()->change();
            $table->json('short_desc')->nullable()->change();
            $table->json('speech')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('founders', function (Blueprint $table) {
            // إعادة الحقول إلى النصوص العادية لو رجعنا الميجريشن
            $table->string('position')->nullable()->change();
            $table->string('short_desc')->nullable()->change();      
            $table->text('speech')->nullable()->change();
        });
    }
};
