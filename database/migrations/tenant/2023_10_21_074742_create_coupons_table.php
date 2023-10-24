<?php

use App\Enums\Vendor\CouponActive;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('coupon_code')->unique();
            $table->string('allowed_time')->nullable();
            $table->string('amount_type');
            $table->decimal('amount');
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_unlimited')->default(CouponActive::INACTIVE->value);
            $table->boolean('active')->default(CouponActive::INACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
