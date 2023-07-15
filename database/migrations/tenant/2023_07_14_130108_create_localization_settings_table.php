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
        Schema::create('localization_settings', function (Blueprint $table) {
            $table->id();
            $table->json('languages');
            $table->string('default_language');
            $table->string('timezone');
            $table->string('date_format');
            $table->string('time_format');
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('currency_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localization_settings');
    }
};
