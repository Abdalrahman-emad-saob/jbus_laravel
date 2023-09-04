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
        $passengerId = $request->user()->id;
        //     ->limit(5)
        // TODO: REDO
        $routes = Route::whereHas('favoritePoints', function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
        })->with(['interest_point_starting', 'interest_point_ending', 'favoritePoints'])->get();

        return $routes;
    }

    public function favoriteRoutes(Request $request)
    {
        $passengerId = $request->user()->id;

        $routesWithFavoritePoints = Route::whereHas('favoritePoints', function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
        })->with(['interest_point_starting', 'interest_point_ending', 'favoritePoints'])->get();

        return $routesWithFavoritePoints;
    }
}
