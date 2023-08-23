<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'number',
        // 'passenger_id',
        'email'
    ];

    // public function passenger()
    // {
    //     return $this->belongsTo(User::class, 'passenger_id', 'id');
    // }
}
