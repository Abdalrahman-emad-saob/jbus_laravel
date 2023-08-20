<?php

namespace App\Http\Controllers\Api\Passenger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FavoritePoint;
use App\Models\Point;

class PointController extends Controller
{
    public function addToFavorite(Request $request)
    {
        $point = Point::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        FavoritePoint::create([
            'passenger_id' => $request->id,
            'point_id' => $point->id,
            'route_id' => $request->route_id
        ]);

        return true;
    }
}
