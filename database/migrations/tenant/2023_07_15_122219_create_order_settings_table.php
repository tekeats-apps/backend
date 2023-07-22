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
        Schema::create('order_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('dine_in')->default(0);
            $table->boolean('pickup')->default(0);
            $table->boolean('delivery')->default(0);
            $table->boolean('cash_on_delivery')->default(0);
            $table->boolean('stripe')->default(0);
            $table->boolean('paypal')->default(0);
            $table->boolean('orders_auto_accept')->default(0);
            $table->boolean('allow_special_instructions')->default(0);
            $table->boolean('allow_order_discounts')->default(0);
            $table->decimal('minimum_order', 8, 2);  // assuming the minimum order amount will have two decimal points
            $table->string('order_preparation_time');
            $table->string('order_lead_time');
            $table->string('order_cutoff_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_settings');
    }
};
