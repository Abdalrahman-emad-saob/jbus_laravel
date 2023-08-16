<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    public function favorite_point()
    {
        return $this->belongsTo(FavoritePoint::class, 'point_id', 'id');
    }
    public function trips_pickup()
    {
        return $this->belongsTo(Trip::class, 'pickup_point_id', 'id');
    }
    public function trips_dropoff()
    {
        return $this->belongsTo(Trip::class, 'dropoff_point_id', 'id');
    }
    public function routes_going()
    {
        return $this->belongsTo(Route::class, 'starting_point', 'id');
    }
    public function routs_returning()
    {
        return $this->belongsTo(Route::class, 'ending_point', 'id');
    }
}
