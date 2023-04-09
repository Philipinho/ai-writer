<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignId('category_id')->nullable();
            $table->string('key')->index()->unique();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->text('prompt')->nullable();
            $table->text('tooltip')->nullable();
            $table->string('icon', 2048)->nullable();
            $table->string('color')->nullable();
            $table->boolean('beta')->default(false);
            $table->boolean('premium_only')->default(true);
            $table->boolean('recommended')->default(false);
            $table->boolean('custom')->default(false);
            $table->smallInteger('order')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
