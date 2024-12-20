<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meter_reading_amount',
        'customer_id',
        'meter_reading_date',
        'meter_reading_type',
    ];

    /**
     * Get the user (customer) associated with the meter reading.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
