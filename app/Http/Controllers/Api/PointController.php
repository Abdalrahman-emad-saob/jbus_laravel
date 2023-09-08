<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FavoritePoint;
use App\Models\Point;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function addToFavorite(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'passenger_id' => 'required',
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

        return response()->json([], 200);
    }

    public function favorites(Request $request)
    {
        $favoritePoints = User::where('id', auth()->user()->id)
            ->first()
            ->favoritePoints()
            ->with('point')
            ->get();

        return response()->json(['favorite_points' => $favoritePoints]);
    }

    public function tripsAndFavorites(Request $request)
    {

        $data = Trip::where('passenger_id', auth()->user()->id)
            ->with(['route.favoritePoints' => function ($query) use ($request) {
                $query->where('passenger_id', auth()->user()->id)
                    ->with('point');
            }])->get();

        return response()->json(['data' => $data]);
    }

    public function deleteFavorite(Request $request, $id)
    {
        $favorite = FavoritePoint::find($id);

        if ($favorite) {
            $favorite->delete();

            if ($favorite->point) {
                $favorite->point->delete();
            }

            return response()->json(['message' => 'point deleted successfully'], 200);
        }

        return response()->json(['message' => 'point not found'], 404);
    }


    public function point(Request $request, $id)
    {
        return response()->json(['point' => Point::where('id', $id)->get()]);
    }
}
