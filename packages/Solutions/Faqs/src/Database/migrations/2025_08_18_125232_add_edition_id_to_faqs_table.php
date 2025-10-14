<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->unsignedBigInteger('edition_id')->nullable()->after('id');
            $table->index('edition_id');
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex(['edition_id']);
            $table->dropColumn('edition_id');
        });
    }
};
