<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use GuzzleHttp\Client;

class BusController extends Controller
{
    public function updateLocation(Request $request)
    {
        $firebase = Firebase::database();
        $database = $firebase->getReference('bus_locations');

        $busId = $request->input('bus_id');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $timestamp = now()->timestamp;

        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'timestamp' => $timestamp,
        ];

        $database->getChild($busId)->set($data);

        return response()->json(['message' => 'Location updated successfully']);
    }
}
