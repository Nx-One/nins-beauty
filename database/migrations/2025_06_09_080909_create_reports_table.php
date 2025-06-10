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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date'); // Date of the report
            $table->decimal('total_income', 10, 2)->nullable(); // Total income for the day
            $table->integer('total_orders')->default(0); // Total number of orders for the day
            $table->string('status')->default('pending'); // pending / completed / failed
            $table->string('description')->nullable(); // Description of the report
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming users table exists
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
