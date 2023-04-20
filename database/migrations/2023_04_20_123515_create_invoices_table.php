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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable();
            $table->foreignId('subscription_id')->nullable();
            $table->string('payment_provider')->nullable();
            $table->string('invoice_id')->unique();
            $table->string('customer')->nullable();
            $table->string('subscription')->nullable();
            $table->string('subscription_item')->nullable();
            $table->string('product')->nullable();
            $table->string('price_id')->nullable();
            $table->string('currency')->nullable();
            $table->integer('amount')->nullable();
            $table->string('invoice_url', 2048)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
