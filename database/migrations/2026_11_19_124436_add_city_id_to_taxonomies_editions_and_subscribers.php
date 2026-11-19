<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Magazine Editions: Add city_id and composite unique index
        Schema::table('magazine_editions', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('id')->constrained('cities')->cascadeOnDelete();
            $table->dropUnique('magazine_editions_issue_number_unique');
            $table->unique(['city_id', 'issue_number']);
        });

        // Backfill existing magazine editions to Bhavnagar
        $bhavnagar = DB::table('cities')->where('slug', 'bhavnagar')->first();
        if ($bhavnagar) {
            DB::table('magazine_editions')->whereNull('city_id')->update(['city_id' => $bhavnagar->id]);
        }

        // 2. Subscribers: Add nullable city_id (NULL = National, set = City-specific)
        Schema::table('subscribers', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('id')->constrained('cities')->nullOnDelete();
        });

        // 3. Categories: Add nullable city_id (NULL = Global baseline, set = City-exclusive)
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('id')->constrained('cities')->cascadeOnDelete();
        });

        // 4. Tags: Add nullable city_id (NULL = Global baseline, set = City-exclusive)
        Schema::table('tags', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('id')->constrained('cities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });

        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });

        Schema::table('magazine_editions', function (Blueprint $table) {
            $table->dropUnique(['city_id', 'issue_number']);
            $table->unique('issue_number');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
