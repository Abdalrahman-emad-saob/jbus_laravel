<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePoint extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'passenger_id',
        'route_id',
        'point_id',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function point()
    {
        return $this->belongsTo(Stop::class, 'point_id', 'id');
    }
}
