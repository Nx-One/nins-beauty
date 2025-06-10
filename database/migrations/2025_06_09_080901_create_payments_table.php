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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Assuming orders table exists
            $table->string('method'); // Payment method (e.g., bank transfer)
            $table->dateTime('payment_date'); // Date and time of the payment
            $table->decimal('total_amount', 10, 2)->nullable(); // Total amount paid
            $table->string('proof_image')->nullable(); // Image of the payment proof
            $table->string('status')->default('pending'); // pending / completed / failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
