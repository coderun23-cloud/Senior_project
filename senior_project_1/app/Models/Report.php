<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = ['report_type', 'generated_by', 'target_user_id', 'metrics'];

    // Define the relationship with the User model
    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
   
    
}
