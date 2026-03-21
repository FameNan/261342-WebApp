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
        Schema::create('seller_products', function (Blueprint $table) {
       $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
        $table->unsignedBigInteger('product_id');
        $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        $table->primary(['seller_id', 'product_id']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_products');
    }
};
