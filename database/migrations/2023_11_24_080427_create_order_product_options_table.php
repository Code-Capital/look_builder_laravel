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
        Schema::create('order_product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_id');
            $table->unsignedBigInteger('custom_option_id');
            $table->foreign('order_product_id')->references('id')->on('order_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('custom_option_id')->references('id')->on('custom_options')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_options');
    }
};
