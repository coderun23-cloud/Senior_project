<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'user_id', 'address', 'phone_number', 'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
