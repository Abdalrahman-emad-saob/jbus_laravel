<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;


    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }
}
