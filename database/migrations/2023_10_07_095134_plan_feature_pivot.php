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
        Schema::create('plan_feature_pivot', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('feature_id');
        });

        Schema::table('plan_feature_pivot', function (Blueprint $table) {
            $table->foreign('plan_id')->references('id')->on('plan_subscriptions')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('plan_features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns('plan_feature_pivot', ['plan_id', 'feature_id'])) {
            Schema::table('plan_feature_pivot', function (Blueprint $table) {
                $table->dropColumn('plan_id');
                $table->dropColumn('feature_id');
            });
        }
    }
};
