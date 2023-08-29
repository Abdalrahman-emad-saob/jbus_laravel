<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestPoint extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'location'
    ];

    // public function InterestRoute()
    // {
    //     return $this->hasMany(InterestRoute::class, 'interest_point_id', 'id');
    // }
    public function route_starting()
    {
        return $this->hasOne(Route::class, 'starting_point', 'id');
    }
    public function route_ending()
    {
        return $this->hasOne(Route::class, 'ending_point', 'id');
    }
    public function point_location()
    {
        return $this->belongsTo(Point::class, 'location', 'id');
    }

}
