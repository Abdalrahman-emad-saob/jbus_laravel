<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerProfile extends Model
{
    use CrudTrait;
    use HasFactory;

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }
}
