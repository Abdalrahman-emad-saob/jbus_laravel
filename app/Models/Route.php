<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public function universities()
    {
        return $this->belongsToMany(University::class, 'university_routes', 'university_id', 'route_id');
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
