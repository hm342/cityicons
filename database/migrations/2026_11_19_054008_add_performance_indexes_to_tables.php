<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * High-performance database indexing for rapid queries.
     */
    public function up(): void
    {
        $hasIndex = function ($table, $indexName) {
            $indexes = DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = '{$indexName}'");
            return !empty($indexes);
        };

        Schema::table('articles', function (Blueprint $table) use ($hasIndex) {
            if (!$hasIndex('articles', 'idx_articles_status_cover')) {
                $table->index(['status', 'is_cover'], 'idx_articles_status_cover');
            }
            if (!$hasIndex('articles', 'idx_articles_status_featured')) {
                $table->index(['status', 'is_featured'], 'idx_articles_status_featured');
            }
            if (!$hasIndex('articles', 'idx_articles_status_section')) {
                $table->index(['status', 'section'], 'idx_articles_status_section');
            }
            if (!$hasIndex('articles', 'idx_articles_status_type')) {
                $table->index(['status', 'type'], 'idx_articles_status_type');
            }
            if (!$hasIndex('articles', 'idx_articles_published_at')) {
                $table->index('published_at', 'idx_articles_published_at');
            }
        });

        Schema::table('people', function (Blueprint $table) use ($hasIndex) {
            if (!$hasIndex('people', 'idx_people_status_type')) {
                $table->index(['status', 'type'], 'idx_people_status_type');
            }
            if (!$hasIndex('people', 'idx_people_status_featured')) {
                $table->index(['status', 'is_featured'], 'idx_people_status_featured');
            }
            if (!$hasIndex('people', 'idx_people_year_month')) {
                $table->index(['year', 'month'], 'idx_people_year_month');
            }
            if (!$hasIndex('people', 'idx_people_sort_order')) {
                $table->index('sort_order', 'idx_people_sort_order');
            }
        });

        Schema::table('nominations', function (Blueprint $table) use ($hasIndex) {
            if (!$hasIndex('nominations', 'idx_nominations_status')) {
                $table->index('status', 'idx_nominations_status');
            }
        });

        Schema::table('brands', function (Blueprint $table) use ($hasIndex) {
            if (!$hasIndex('brands', 'idx_brands_active_featured')) {
                $table->index(['is_active', 'is_featured'], 'idx_brands_active_featured');
            }
        });

        Schema::table('magazine_editions', function (Blueprint $table) use ($hasIndex) {
            if (!$hasIndex('magazine_editions', 'idx_magazines_is_active')) {
                $table->index('is_active', 'idx_magazines_is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $hasIndex = function ($table, $indexName) {
            $indexes = DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = '{$indexName}'");
            return !empty($indexes);
        };

        Schema::table('articles', function (Blueprint $table) use ($hasIndex) {
            if ($hasIndex('articles', 'idx_articles_status_cover')) $table->dropIndex('idx_articles_status_cover');
            if ($hasIndex('articles', 'idx_articles_status_featured')) $table->dropIndex('idx_articles_status_featured');
            if ($hasIndex('articles', 'idx_articles_status_section')) $table->dropIndex('idx_articles_status_section');
            if ($hasIndex('articles', 'idx_articles_status_type')) $table->dropIndex('idx_articles_status_type');
            if ($hasIndex('articles', 'idx_articles_published_at')) $table->dropIndex('idx_articles_published_at');
        });

        Schema::table('people', function (Blueprint $table) use ($hasIndex) {
            if ($hasIndex('people', 'idx_people_status_type')) $table->dropIndex('idx_people_status_type');
            if ($hasIndex('people', 'idx_people_status_featured')) $table->dropIndex('idx_people_status_featured');
            if ($hasIndex('people', 'idx_people_year_month')) $table->dropIndex('idx_people_year_month');
            if ($hasIndex('people', 'idx_people_sort_order')) $table->dropIndex('idx_people_sort_order');
        });

        Schema::table('nominations', function (Blueprint $table) use ($hasIndex) {
            if ($hasIndex('nominations', 'idx_nominations_status')) $table->dropIndex('idx_nominations_status');
        });

        Schema::table('brands', function (Blueprint $table) use ($hasIndex) {
            if ($hasIndex('brands', 'idx_brands_active_featured')) $table->dropIndex('idx_brands_active_featured');
        });

        Schema::table('magazine_editions', function (Blueprint $table) use ($hasIndex) {
            if ($hasIndex('magazine_editions', 'idx_magazines_is_active')) $table->dropIndex('idx_magazines_is_active');
        });
    }
};
