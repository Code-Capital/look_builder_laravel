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
        Schema::create('cart_product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_product_id');
            $table->unsignedBigInteger('custom_option_id');
            // $table->unsignedBigInteger('custom_product_id');
            // $table->foreign('custom_product_id')->references('id')->on('custom_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cart_product_id')->references('id')->on('cart_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('custom_option_id')->references('id')->on('custom_options')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_product_options');
    }
};
