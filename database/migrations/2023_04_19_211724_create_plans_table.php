<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_monthly_price_id')->nullable();
            $table->string('stripe_yearly_price_id')->nullable();
            $table->string('monthly_amount')->nullable();
            $table->string('yearly_amount')->nullable();
            $table->string('currency')->nullable();
            $table->integer('word_limit')->default(0);
            $table->integer('credits')->default(0);
            $table->integer('seats')->default(0);
            $table->integer('trial_days')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('free')->default(false);
            $table->smallInteger('order')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('plans')->insert([
            'name' => 'Free',
            'description' => 'A free plan with limited features',
            'features' => ["2,000 Credits", "1 seat", "50+ Templates", "Support for 25+ languages", "Rich text editor", "Priority support"],
            'currency' => 'usd',
            'word_limit' => 2000,
            'credits' => 2000,
            'seats' => 1,
            'free' => true,
            'order' => 1,
            'status' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
