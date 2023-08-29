<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InterestPoint;
use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\Request;

class InterestRoutesController extends Controller
{
    public function interestRoutes(Request $request)
    {
        // $universityName = $request->name;

        // $routes = University::where('name', 'like', '%' . $universityName . '%')
        //     ->with('UniversityRoute.route')
        //     ->limit(5)
        //     ->get();
        // return response()->json($routes);
        $id = $request->passenger_id;
        $interestRoutes = InterestPoint::with(['route_starting.favoritePoints' => function ($query) use ($id) {
                $query->where('passenger_id', $id);
            }])->get();

        return $interestRoutes;
    }

    public function favoriteRoutes(Request $request)
    {
        $passengerId = $request->passenger_id;

        $routesWithFavoritePoints = Route::whereHas('favoritePoints', function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
        })
            ->with(['favoritePoints' => function ($query) use ($passengerId) {
                $query->where('passenger_id', $passengerId);
            }])
            ->get();

        return $routesWithFavoritePoints;
    }
}
