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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('look_builder_product_id')->nullable();
            $table->unsignedBigInteger('custom_product_id')->nullable();
            $table->string('size');
            $table->float('price')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('look_builder_product_id')->references('id')->on('look_builder_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('custom_product_id')->references('id')->on('custom_products')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
