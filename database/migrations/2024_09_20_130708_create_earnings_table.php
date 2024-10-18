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
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('transaction_id');
            $table->enum('payment_provider', ['paypal', 'razorpay', 'stripe','offline']);
            $table->foreignId('employer_id')->constrained('employers')->onDelete('cascade');
            $table->foreignId('price_plans_id')->constrained('price_plans')->onDelete('cascade');
            $table->string('amount')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('usd_amount')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('payment_type', ['monthly', 'yearly']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
};
