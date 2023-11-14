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
        Schema::create('look_builder_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('product_image');
            $table->string('layer_image');
            $table->string('color');
            $table->string('size');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('look_builder_products');
    }
};
