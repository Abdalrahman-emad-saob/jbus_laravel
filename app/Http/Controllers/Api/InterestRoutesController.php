<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InterestPoint;
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
        // TODO
        $universities = InterestPoint::with(['universityRoute' => function ($query) use ($id) {
            $query->with(['route.favoritePoints' => function ($query) use ($id) {
                $query->where('passenger_id', $id);
            }]);
        }])->get();

        return $universities;
    }
    // TODO
    public function favoriteInterests(Request $request)
    {
        return InterestPoint::whereHas('universityRoute.route.favoritePoints', function($query) use ($request) {
            $query->where('id', $request->passenger_id);
        })->get();
    }
}
