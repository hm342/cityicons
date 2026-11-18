<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();

            // Author
            $table->string('author_name')->nullable();
            $table->text('author_bio')->nullable();
            $table->string('author_avatar')->nullable();

            // Relations
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();

            // Media
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable();

            // Classification
            $table->enum('type', ['article', 'story', 'in-bhavnagar', 'the-list'])->default('article');
            $table->enum('section', ['icons', 'rising', 'voices', 'general'])->default('general');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            // Flags
            $table->boolean('is_cover')->default(false);
            $table->boolean('is_featured')->default(false);

            // Meta
            $table->string('read_time')->nullable(); // e.g. "5 min read"
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
