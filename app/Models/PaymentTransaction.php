<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'amount',
        'passenger_id',
        'trip_id',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }


    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }
}
