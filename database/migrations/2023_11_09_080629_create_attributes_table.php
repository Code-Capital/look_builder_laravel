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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->text('description');

            $table->unsignedBigInteger('look_builder_product_id')->nullable();
            $table->foreign('look_builder_product_id')->references('id')->on('look_builder_products')->onUpdate('cascade')->onDelete('cascade');

            // in new file it exist
            $table->unsignedBigInteger('custom_product_id')->nullable();
            $table->foreign('custom_product_id')->references('id')->on('custom_products')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
