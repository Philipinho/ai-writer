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
        Schema::create('document_content', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            // Basic information
            $table->string('name', 255)->nullable();
            $table->longText('content')->nullable();
            $table->integer('word_count')->default(0);

            // Prompts and metadata
            $table->text('prompt')->nullable();
            $table->text('metadata')->nullable();

            // Relationships
            $table->foreignId('user_id')->nullable();
            $table->foreignId('document_id')->nullable();
            $table->foreignId('template_id')->nullable();


            // Status and flags
            $table->tinyInteger('is_saved')->default(0);
            $table->tinyInteger('favorite')->default(false);
            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('document_content');
    }
};
