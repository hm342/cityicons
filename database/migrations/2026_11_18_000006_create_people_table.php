<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            // Type: which section they belong to
            $table->enum('type', ['icon', 'rising', 'voice'])->default('icon');

            // Profile info
            $table->string('tagline')->nullable();
            $table->longText('bio')->nullable();
            $table->string('profession')->nullable();
            $table->string('organization')->nullable();

            // Media
            $table->string('cover_image')->nullable();
            $table->string('portrait_image')->nullable();
            $table->json('gallery_images')->nullable();

            // Relations
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            // The List assignment
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedTinyInteger('month')->nullable(); // 1–12

            // Magazine assignment
            $table->unsignedSmallInteger('edition_number')->nullable();

            // Social links
            $table->string('social_instagram')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('website')->nullable();

            // Meta
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
