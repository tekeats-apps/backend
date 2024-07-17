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
        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('plugin_type_id');
            $table->foreign('plugin_type_id')->references('id')->on('plugin_types')->onDelete('cascade');
            $table->string('name');
            $table->text('image')->nullable();
            $table->text('documentation')->nullable();
            $table->text('video')->nullable();
            $table->text('description')->nullable();
            $table->string('version')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->decimal('price')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('featured')->default(false);
            $table->json('setting_fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugins');
    }
};
