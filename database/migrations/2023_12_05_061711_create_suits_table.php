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
        Schema::create('suits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('uuid');
            $table->string('product_image');
            $table->unsignedBigInteger('shirt_id')->nullable();
            $table->foreign('shirt_id')->references('id')->on('look_builder_products')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('trouser_id')->nullable();
            $table->foreign('trouser_id')->references('id')->on('look_builder_products')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suits');
    }
};
