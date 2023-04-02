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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();

            // Basic information
            $table->string('name', 255)->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('word_count')->default(0);
            $table->string('template_key')->nullable();

            // Relationships
            $table->foreignId('user_id')->nullable();
            $table->foreignId('template_id')->nullable();
            $table->foreignId('folder_id')->nullable();
            $table->foreignId('tag_id')->nullable();

            // Status and flags
            $table->tinyInteger('favorite')->default(0);
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
        Schema::dropIfExists('documents');
    }
};
