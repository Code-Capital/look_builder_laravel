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
        Schema::create('custom_option_images', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence_no');
            $table->string('layer_image');
            $table->unsignedBigInteger('custom_option_id')->nullable();
            $table->foreign('custom_option_id')->references('id')->on('custom_options')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('fabric_id')->nullable();
            $table->foreign('fabric_id')->references('id')->on('fabrics')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_option_images');
    }
};
