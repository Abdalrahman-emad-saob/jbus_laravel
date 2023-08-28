<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function rateTrip(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'trip_id' => 'required|exists:trips,id'
        ]);

        $user_id = auth()->user()->id;

        $trip = Trip::where('id', $validatedData['trip_id'])
            ->where('passenger_id', $user_id)
            ->where('status', Trip::$completed)
            ->first();

        if (!$trip) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $trip->rating = $validatedData['rating'];
        $trip->save();

        return response()->json(['message' => 'Trip rated successfully']);
    }
}
