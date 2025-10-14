<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('main_sliders', function (Blueprint $table) {
            // إضافة الحقول الجديدة
            if (!Schema::hasColumn('main_sliders', 'background_ar')) {
                $table->string('background_ar')->nullable()->after('image');
            }
            if (!Schema::hasColumn('main_sliders', 'background_en')) {
                $table->string('background_en')->nullable()->after('background_ar');
            }
        });

        // لو كان فيه عمود background قديم انقل قيمته للعمودين الجدد
        if (Schema::hasColumn('main_sliders', 'background')) {
            DB::table('main_sliders')->update([
                'background_ar' => DB::raw('COALESCE(background_ar, background)'),
                'background_en' => DB::raw('COALESCE(background_en, background)'),
            ]);

            // لازم نحذف العمود في خطوة منفصلة
            Schema::table('main_sliders', function (Blueprint $table) {
                $table->dropColumn('background');
            });
        }
    }

    public function down(): void
    {
        // أرجع العمود القديم
        Schema::table('main_sliders', function (Blueprint $table) {
            if (!Schema::hasColumn('main_sliders', 'background')) {
                $table->string('background')->nullable()->after('image');
            }
        });

        // رجّع أي قيمة من العربي (ولو فاضي خُد الانجليزي)
        DB::table('main_sliders')->update([
            'background' => DB::raw('COALESCE(background_ar, background_en)')
        ]);

        // احذف الأعمدة الجديدة
        Schema::table('main_sliders', function (Blueprint $table) {
            if (Schema::hasColumn('main_sliders', 'background_ar')) {
                $table->dropColumn('background_ar');
            }
            if (Schema::hasColumn('main_sliders', 'background_en')) {
                $table->dropColumn('background_en');
            }
        });
    }
};
