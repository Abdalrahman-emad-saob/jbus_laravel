<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ChargingTransaction extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'amount',
        'passenger_id',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }
}
