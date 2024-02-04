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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('last_name')->nullable()->change();
            $table->string('social_provider')->nullable()->after('last_name');
            $table->string('social_id')->nullable()->unique()->after('social_provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('last_name')->nullable(false)->change();
            $table->dropColumn('social_id');
            $table->dropColumn('social_provider');
        });
    }
};
