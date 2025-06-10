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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Assuming orders table exists
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Assuming products table exists
            $table->integer('quantity')->default(1); // Quantity of the product in the order
            $table->decimal('subtotal', 10, 2)->nullable(); // Subtotal for the product in the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
