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
        Schema::create('delivery_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('free_delivery')->default(0);
            $table->enum('delivery_unit', ['kilometers', 'miles', 'meters']);
            $table->decimal('delivery_radius', 8, 2);
            $table->decimal('delivery_charges', 8, 2);
            $table->decimal('additional_charges', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_settings');
    }
};
