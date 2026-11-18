<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();

            // Nominee info
            $table->string('nominee_name');
            $table->string('nominee_city');
            $table->string('nominee_profession')->nullable();
            $table->foreignId('nominee_category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->text('nominee_description')->nullable();
            $table->string('nominee_social_instagram')->nullable();
            $table->string('nominee_social_linkedin')->nullable();
            $table->string('nominee_website')->nullable();
            $table->string('nominee_image_path')->nullable();

            // Nominator info
            $table->string('nominator_name');
            $table->string('nominator_email');
            $table->string('nominator_phone')->nullable();
            $table->string('relationship_to_nominee')->nullable();

            // Admin workflow
            $table->enum('status', ['pending', 'reviewed', 'approved', 'rejected', 'converted'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->foreignId('converted_to_person_id')->nullable()->constrained('people')->nullOnDelete();

            // The 5 consent checkboxes from the nominate form
            $table->boolean('consent_accuracy')->default(false);
            $table->boolean('consent_sharing')->default(false);
            $table->boolean('consent_editorial')->default(false);
            $table->boolean('consent_no_payment')->default(false);
            $table->boolean('consent_terms')->default(false);

            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nominations');
    }
};
