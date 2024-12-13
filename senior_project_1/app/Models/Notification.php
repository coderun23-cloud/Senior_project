<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = [
        'user_id', 'message', 'notification_type', 'sent_at', 'is_read',
    ];

    // Relationship: A notification belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // assuming the sender is a user
    }
    
}
