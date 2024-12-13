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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meter_reading_id')->constrained()->onDelete('cascade'); // References the meter readings
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Customer ID (assuming 'users' table exists)
            $table->foreignId('tariff_id')->constrained()->onDelete('cascade'); // Tariff ID (assuming 'tariffs' table exists)
            $table->decimal('energy_consumed', 8, 2); // Amount of energy consumed
            $table->decimal('bill_amount', 10, 2); // Calculated bill amount
            $table->enum('status', ['unpaid', 'paid', 'partially_paid'])->default('unpaid'); // Bill status
            $table->date('due_date'); // Due date for the bill
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
