<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class InterestRoutesController extends Controller
{
    // TODO
    public function interestRoutes(Request $request)
    {
        $passengerId = $request->user()->id;

        $routes = Route::with([
            'interest_point_starting',
            'interest_point_ending',
            'favoritePoints' => function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
            },
            'favoritePoints.point'
        ])->get();

        return response()->json(['routes' => $routes]);
    }

    public function favoriteRoutes(Request $request)
    {
        $passengerId = $request->user()->id;

        $routesWithFavoritePoints = Route::whereHas(
            'favoritePoints',
            function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
        })->with([
            'interest_point_starting',
            'interest_point_ending',
            'favoritePoints'
            ])->get();

        return response()->json(['routes-with-favorite-points' => $routesWithFavoritePoints]);
    }
}
