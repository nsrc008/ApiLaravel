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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total', 10, 2);
            $table->timestamp('order_date');
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('product_details', function (Blueprint $table) {
            $table->id('id_product_detail');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity');
            $table->timestamps();
    
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('id_product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
