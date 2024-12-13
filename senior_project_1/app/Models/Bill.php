<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meter_reading_id',
        'tariff_id',
        'energy_consumed',
        'bill_amount',
        'status',
        'due_date',
    ];

    /**
     * Get the tariff for the bill.
     */
    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    /**
     * Get the user (customer) for the bill.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the meter reading for the bill.
     */
    public function meterReading()
    {
        return $this->belongsTo(MeterReading::class);
    }

    /**
     * Calculate the bill amount based on energy consumed and the tariff rate.
     */
    public function calculateBillAmount()
    {
        // Get the tariff based on energy consumption
        $tariff = $this->tariff;
        
        // Calculate the bill amount based on price per unit
        if ($tariff->isInRange($this->energy_consumed)) {
            $this->bill_amount = $this->energy_consumed * $tariff->price_per_unit;
            $this->save(); // Save the calculated bill amount
        } else {
            // Handle case when energy consumed is out of tariff range
            throw new \Exception('Energy consumption is out of range for the selected tariff.');
        }
    }
   
}
