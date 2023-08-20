<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'rating',
        'finished_at',
        'status',
        'passenger_id',
        'route_id',
        'pickup_point_id',
        'dropoff_point_id',
        'bus_id',
    ];

    // enums
    static $canceled = 'CANCELED';
    static $completed = 'COMPLETED';
    static $onGoing = 'ONGOING';

    // relationships

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }
    public function pickupPoint()
    {
        return $this->belongsTo(Point::class, 'pickup_point_id', 'id');
    }
    public function dropoffPoint()
    {
        return $this->belongsTo(Point::class, 'dropoff_point_id', 'id');
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }
}
