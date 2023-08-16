<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'starting_point',
        'ending_point',
        'waypoints_going',
        'waypoints_returning',
    ];

    public function universityRoute()
    {
        return $this->hasOne(UniversityRoute::class, 'route_id', 'id');
    }

    public function favoritePoints()
    {
        return $this->hasMany(FavoritePoint::class, 'route_id', 'id');
    }

    public function buses()
    {
        return $this->hasMany(Bus::class, 'route_id', 'id');
    }


    public function trips()
    {
        return $this->hasMany(Trip::class, 'route_id', 'id');
    }
}
