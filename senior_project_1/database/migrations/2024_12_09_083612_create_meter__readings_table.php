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
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Customer ID
            $table->decimal('meter_reading_amount', 10, 2); // Meter reading amount (could be energy consumption, e.g., in kWh)
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade'); // Assuming the same user table
            $table->date('meter_reading_date'); // Date of the meter reading
            $table->enum('meter_reading_type', ['manual', 'scanning']); // Type of reading (manual or scanning)
            $table->timestamps(); // Created and updated timestamps
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter__readings');
    }
};
