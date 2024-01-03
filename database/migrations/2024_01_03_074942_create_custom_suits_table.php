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
        Schema::create('custom_suits', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->unsignedBigInteger('jacket_id');
            $table->unsignedBigInteger('pant_id');
            $table->unsignedBigInteger('waistcoat_id');
            $table->foreign('jacket_id')->references('id')->on('custom_products');
            $table->foreign('pant_id')->references('id')->on('custom_products');
            $table->foreign('waistcoat_id')->references('id')->on('custom_products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_suits');
    }
};
