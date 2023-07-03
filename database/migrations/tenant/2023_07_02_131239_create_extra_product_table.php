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
        Schema::create('extra_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('extra_id');
            $table->timestamps();
            $table->unique(['product_id', 'extra_id']);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_product');
    }
};
