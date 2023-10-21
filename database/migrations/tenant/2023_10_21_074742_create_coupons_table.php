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
            $table->string('vendor_id');
            $table->string('coupon_option');
            $table->string('coupon_code')->unique();
            $table->string('type');
            $table->string('amount_type');
            $table->decimal('amount');
            $table->date('expiry_date')->nullable();
            $table->boolean('active')->default(CouponActive::IN_ACTIVE->value);
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
