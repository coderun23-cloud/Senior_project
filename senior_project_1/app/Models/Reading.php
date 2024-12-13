<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    //
    protected $fillable = [
        'meter_reader_id',
        'customer_id',
        'amount',
        'reading_date',
        'reading_type',
    ];

    // Define the relationship with the meter reader
    public function meterReader()
    {
        return $this->belongsTo(User::class, 'meter_reader_id');
    }

    // Define the relationship with the customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
