<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Kreait\Laravel\Firebase\Facades\Firebase;
use GuzzleHttp\Client;
// use Kreait\Firebase\Exception\AuthException;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;

class BusController extends Controller
{
    public function updateLocation(Request $request)
    {

        try {
            $customToken = Firebase::auth()->createCustomToken($request->bus_id);
            $idToken = Firebase::auth()->signInWithCustomToken($customToken)->idToken();
        } catch (Exception $e) {
            return response()->json(['message' => 'Authentication error'], 401);
        }

        // Send the bus location to Firebase
        $database = Firebase::database();
        $reference = $database->getReference("bus_locations/{$request->bus_id}");

        $reference->set([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return response()->json(['message' => 'Location updated successfully']);
    }
        // Authenticate with Firebase and get the ID token
        // $serviceAccount = ServiceAccount::fromJsonFile(storage_path('jbus-8f9bf-firebase-adminsdk-ai17o-df9754ead0.json'));
        // $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
        // $auth = $firebase->getAuth();

        // try {
        //     $customToken = $auth->createCustomToken($request->bus_id);
        //     $verifiedIdToken = $auth->signInWithCustomToken($customToken)->idToken();
        // } catch (AuthException $e) {
        //     return response()->json(['message' => 'Authentication error'], 401);
        // }
        // // Send the bus location to Firebase
        // $firebaseUrl = 'https://console.firebase.google.com/u/0/project/jbus-8f9bf/database/jbus-8f9bf-default-rtdb/data/~2F';
        // $requestUrl = $firebaseUrl . 'bus_locations.json';

        // $client = new Client();
        // $response = $client->post($requestUrl, [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . $idToken,
        //     ],
        //     'json' => [
        //         'latitude' => $request->input('latitude'),
        //         'longitude' => $request->input('longitude'),
        //     ],
        // ]);

        // if ($response->getStatusCode() === 200) {
        //     return response()->json(['message' => 'Location updated successfully']);
        // } else {
        //     return response()->json(['message' => 'Failed to update location'], 500);
        // }
        // $firebase = Firebase::database();
        // $database = $firebase->getReference('bus_locations');

        // $busId = $request->input('bus_id');
        // $latitude = $request->input('latitude');
        // $longitude = $request->input('longitude');
        // $timestamp = now()->timestamp;

        // $data = [
        //     'latitude' => $latitude,
        //     'longitude' => $longitude,
        //     'timestamp' => $timestamp,
        // ];

        // $database->getChild($busId)->set($data);

        // return response()->json(['message' => 'Location updated successfully']);
    }

