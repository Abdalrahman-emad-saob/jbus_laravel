<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    public function route()
    {
        return $this->belongsToMany(Route::class, 'university_routes', 'route_id', 'university_id');
    }
}
