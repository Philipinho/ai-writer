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

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->onDelete('cascade');
            $table->string('label');
            $table->string('name');
            $table->boolean('required')->default(true);
            $table->text('placeholder')->nullable();
            $table->string('type');
            $table->text('tooltip')->nullable();
            $table->tinyInteger('order');
            $table->integer('minLength')->nullable();
            $table->integer('maxLength')->nullable();
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
