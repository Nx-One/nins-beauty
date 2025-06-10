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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('full_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'address', 'phone', 'payment_method', 'payment_proof']);
        });
    }
};
