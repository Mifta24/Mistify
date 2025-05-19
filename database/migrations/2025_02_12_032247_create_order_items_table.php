<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('product_name');  // Snapshot dari nama produk
            $table->decimal('price', 10, 2);  // Snapshot dari harga produk
            $table->integer('quantity');
            $table->string('size')->nullable();  // Optional size field
            $table->decimal('subtotal', 10, 2);  // price * quantity
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
