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
            $table->increments('id');
            $table->uuid();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->string('name', 128);
            $table->string('key', 128);
            $table->string('slug', 64)->unique()->nullable();
            $table->text('description')->nullable();
            $table->text('prompt')->nullable();
            $table->text('icon')->nullable();
            $table->string('color')->nullable();
            $table->tinyInteger('status')->default(0);
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
