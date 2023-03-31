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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->integer('trial_days')->nullable();
            $table->string('currency', 12);
            $table->text('coupons')->nullable();
            $table->text('tax_rates')->nullable();
            $table->string('amount_month', 32)->nullable()->default('0');
            $table->string('amount_year', 32)->nullable()->default('0');
            $table->tinyInteger('visibility')->nullable();
            $table->unsignedInteger('position')->nullable()->default(0);
            $table->text('features')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
