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
            $table->uuid();
            $table->foreignId('category_id')->nullable();
            $table->string('key')->unique();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->text('prompt')->nullable();
            $table->text('tooltip')->nullable();
            $table->text('icon')->nullable();
            $table->string('color')->nullable();
            $table->boolean('beta')->default(false);
            $table->boolean('premium_only')->default(true);
            $table->boolean('recommended')->default(false);
            $table->boolean('custom')->default(false);
            $table->smallInteger('order');
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
