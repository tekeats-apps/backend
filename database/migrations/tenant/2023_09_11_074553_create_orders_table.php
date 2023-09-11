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
            $table->enum(
                'status',
                [
                    'pending',
                    'processing',
                    'assigned_to_driver',
                    'on_the_way',
                    'completed',
                    'returned',
                    'cancelled'
                ]
            )->default('pending');
            $table->enum('payment_method', ['card', 'paypal', 'cash_on_delivery']);
            $table->enum('order_type', ['dine_in', 'takeaway', 'delivery']);

            $table->string('coupon_code')->nullable();
            $table->text('notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->text('return_reason')->nullable();

            $table->decimal('subtotal_price', 10, 2)->default(0.00);
            $table->decimal('total_price', 10, 2)->default(0.00);

            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
