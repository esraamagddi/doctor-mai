<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->unsignedBigInteger('role_id')
                      ->nullable()
                      ->after('avatar')
                      ->index();
            }
        });

        // نحاول نضيف المفتاح الأجنبي (لو مش متضاف قبل كده مش هيعمل مشكلة)
        try {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasTable('roles')) {
                    $table->foreign('role_id')
                          ->references('id')
                          ->on('roles')
                          ->nullOnDelete();
                }
            });
        } catch (\Throwable $e) {
            // تجاهل أي خطأ في حالة المفتاح مضاف قبل كده
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            try {
                $table->dropForeign(['role_id']);
            } catch (\Throwable $e) {
                // تجاهل الخطأ لو المفتاح مش موجود
            }

            if (Schema::hasColumn('users', 'role_id')) {
                $table->dropColumn('role_id');
            }
        });
    }
};
