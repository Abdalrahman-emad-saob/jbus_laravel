<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FavoritePoint;
use App\Models\Point;
use App\Models\Trip;
use App\Models\User;

class PointController extends Controller
{
    public function addToFavorite(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'passenger_id' => 'required',
            'point_id' => 'required',
            'route_id' => 'required',
        ]);
        $point = Point::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        FavoritePoint::create([
            'passenger_id' => $request->passenger_id,
            'point_id' => $point->id,
            'route_id' => $request->route_id
        ]);

        return true;
    }

    public function returnFavorites(Request $request)
    {
        $request->validate([
            'passenger_id' => 'required',
        ]);

        return User::where('id', $request->passenger_id)
            ->first()
            ->favoritePoints()
            ->with('point')
            ->get();
    }

    public function returnTripsandFavorites(Request $request)
    {
        $request->validate([
            'passenger_id' => 'required',
        ]);

        return Trip::where('passenger_id', $request->passenger_id)
            ->with(['route.favoritePoints' => function ($query) use ($request) {
                $query->where('passenger_id', $request->passenger_id)
                    ->with('point');
            }])->get();
    }

    public function deleteFavorite(Request $request)
    {
        $request->validate([
            'point_id' => 'required',
        ]);
        return Point::find($request->point_id)->delete();
    }
}
