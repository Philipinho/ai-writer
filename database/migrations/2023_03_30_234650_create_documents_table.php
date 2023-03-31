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
            $table->foreignId('user_id')->index('user_id');
            $table->foreignId('template_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->longText('content')->nullable();
            $table->integer('words')->default(0);
            $table->text('prompt')->nullable();
            $table->text('settings')->nullable();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('tag_id')->nullable();
            $table->boolean('favorite')->default(false);
            $table->tinyInteger('status')->default(0);
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
