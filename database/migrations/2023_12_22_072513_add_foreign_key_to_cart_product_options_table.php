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
        Schema::table('cart_product_options', function (Blueprint $table) {
            $table->unsignedBigInteger('custom_product_id')->nullable();
            $table->foreign('custom_product_id')->references('id')->on('custom_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_product_options', function (Blueprint $table) {
            //
        });
    }
};
