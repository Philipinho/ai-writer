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
        Schema::create('team_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->string('subscription_plan')->nullable();
            $table->bigInteger('credits');
            $table->bigInteger('original_plan_credits')->default(0);
            $table->bigInteger('free_credits')->nullable()->default(0);
            $table->string('interval')->nullable();
            $table->dateTime('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_credits');
    }
};
