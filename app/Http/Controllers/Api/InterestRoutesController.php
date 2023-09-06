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
        $passengerId = Auth::id();
        //     ->limit(5)

        $routes = Route::whereHas('favoritePoints', function ($query) use ($passengerId) {
            $query->where('passenger_id', $passengerId);
        })->with(['interest_point_starting', 'interest_point_ending', 'favoritePoints'])->get();
        return $routes;
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
