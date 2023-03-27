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
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->string('customer_name');
            $table->string('email');
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['active', 'pending', 'failed', 'expired'])->default('pending');
            $table->enum('payment_status', ['completed', 'pending', 'failed'])->default('pending');
            $table->timestamps();
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
