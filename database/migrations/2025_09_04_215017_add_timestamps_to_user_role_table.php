<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_role', function (Blueprint $table) {
            if (!Schema::hasColumn('user_role', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('user_role', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
