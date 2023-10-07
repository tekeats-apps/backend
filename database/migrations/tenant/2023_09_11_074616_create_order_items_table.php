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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->json('extras')->nullable();
            $table->integer('quantity')->default(1);
            $table->text('special_instructions')->nullable();

            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('set null');

            // Indexes
            $table->index('order_id');
            $table->index('product_id');
            $table->index('variant_id');
            $table->index(['order_id', 'product_id']); // composite index
            $table->index(['order_id', 'created_at']); // for ordering by creation time within a specific order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
