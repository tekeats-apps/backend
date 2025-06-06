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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->string('status')->default('pending');
            $table->string('payment_method');
            $table->string('order_type');
            $table->string('payment_status');

            $table->string('coupon_code')->nullable();
            $table->text('notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->text('return_reason')->nullable();

            $table->decimal('subtotal_price', 10, 2)->default(0.00);
            $table->decimal('total_price', 10, 2)->default(0.00);

            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            // Indexes
            $table->index('customer_id');
            $table->index('status');
            $table->index('payment_method');
            $table->index('order_type');
            $table->index('payment_status');
            $table->index(['customer_id', 'status']); // Composite index
            $table->index(['customer_id', 'order_type']);
            $table->index(['customer_id', 'created_at']); // For ordering by creation time within a specific customer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
