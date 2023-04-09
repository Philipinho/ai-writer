<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_contents', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();

            // Basic information
            $table->text('content')->nullable();
            $table->integer('word_count')->default(0);

            // Prompts and metadata
            $table->text('prompt')->nullable();
            $table->json('metadata')->nullable();
            // Relationships
            $table->foreignId('document_id')->nullable();
            $table->foreignId('template_id')->nullable();
            $table->string('template_key')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();

            // Status and flags
            $table->boolean('saved')->default(0);
            $table->boolean('favorite')->default(false);
            $table->tinyInteger('status')->default(1);

            // Timestamps and soft deletes
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_contents');
    }
};
