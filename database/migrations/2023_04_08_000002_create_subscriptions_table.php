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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('plan_id')->nullable();
            $table->string('stripe_customer_id')->unique();
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price_id')->nullable();
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_item_id')->nullable();
            $table->integer('amount')->nullable();
            $table->string('currency')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('interval')->nullable();
            $table->string('payment_provider')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('next_payment_date')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['team_id', 'stripe_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
