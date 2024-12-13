<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    //
    protected $fillable = [
        'tariff_name',
        'unit_range_start',
        'unit_range_end',
        'price_per_unit',
        'effective_date',
    ];

    /**
     * Get the bills associated with the tariff.
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * Check if a given energy consumption falls within the tariff's unit range.
     */
    public function isInRange($energyConsumed)
    {
        return $energyConsumed >= $this->unit_range_start && $energyConsumed <= $this->unit_range_end;
    }
}
