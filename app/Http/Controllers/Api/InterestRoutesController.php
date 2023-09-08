<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InterestPoint;
use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestRoutesController extends Controller
{
    // TODO
    public function interestRoutes(Request $request)
    {
        $passengerId = $request->user()->id;
        //     ->limit(5)

        // TODO: REDO
        $routes = Route::with(['interest_point_starting', 'interest_point_ending', 'favoritePoints' => function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
        }])->get();

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
