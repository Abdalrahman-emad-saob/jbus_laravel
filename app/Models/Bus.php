<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'number',
        'capacity',
        'route_id',
        'driver_id',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class, 'bus_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
}
