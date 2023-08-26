<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityRoutesController extends Controller
{
    public function returnUniversitiesRoutes(Request $request)
    {
        // $universityName = $request->name;

        // $routes = University::where('name', 'like', '%' . $universityName . '%')
        //     ->with('UniversityRoute.route')
        //     ->limit(5)
        //     ->get();
        // return response()->json($routes);
        $id = $request->passenger_id;
        $universities = University::with(['universityRoute' => function ($query) use ($id) {
            $query->with(['route.favoritePoints' => function ($query) use ($id) {
                $query->where('passenger_id', $id);
            }]);
        }])->get();

        return $universities;
    }

    public function returnFavoriteUniversities(Request $request)
    {
        return University::whereHas('universityRoute.route.favoritePoints', function($query) use ($request) {
            $query->where('id', $request->id);
        })->get();
    }
}
