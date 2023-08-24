<?php

namespace Database\Factories;

use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'starting_point' => Point::all()->random()->id,
            'ending_point' => Point::all()->random()->id,
            'waypoints_going' => json_encode([
                [
                    "Location" => [
                        "Latitude" => 52.1615470947258,
                        "Longitude" => 20.80514430999756,
                    ],
                ],
                [
                    "Position" => [
                        "Latitude" => 52.15991486090931,
                        "Longitude" => 20.804049968719482,
                    ],
                ],
                [
                    "Coordinates" => [
                        "Latitude" => 52.15772967999426,
                        "Longitude" => 20.805788040161133,
                    ],
                ],
                [
                    "GeoData" => [
                        "Latitude" => 52.15586034371232,
                        "Longitude" => 20.80460786819458,
                    ],
                ],
                [
                    "Place" => [
                        "Latitude" => 52.15923693975469,
                        "Longitude" => 20.80113172531128,
                    ],
                ],
                [
                    "Positioning" => [
                        "Latitude" => 52.159849043774074,
                        "Longitude" => 20.791990756988525,
                    ],
                ],
                [
                    "MapInfo" => [
                        "Latitude" => 52.15986220720892,
                        "Longitude" => 20.790467262268066,
                    ],
                ],
                [
                    "GPS" => [
                        "Latitude" => 52.16202095784738,
                        "Longitude" => 20.7806396484375,
                    ],
                ],
                [
                    "PlaceCoordinates" => [
                        "Latitude" => 52.16088894313116,
                        "Longitude" => 20.77737808227539,
                    ],
                ],
                [
                    "Waypoint" => [
                        "Latitude" => 52.15255590234335,
                        "Longitude" => 20.784244537353516,
                    ],
                ],
            ]),
            'waypoints_returning' => json_encode([
                [
                    "Location" => [
                        "Latitude" => 52.1615470947258,
                        "Longitude" => 20.80514430999756,
                    ],
                ],
                [
                    "Position" => [
                        "Latitude" => 52.15991486090931,
                        "Longitude" => 20.804049968719482,
                    ],
                ],
                [
                    "Coordinates" => [
                        "Latitude" => 52.15772967999426,
                        "Longitude" => 20.805788040161133,
                    ],
                ],
                [
                    "GeoData" => [
                        "Latitude" => 52.15586034371232,
                        "Longitude" => 20.80460786819458,
                    ],
                ],
                [
                    "Place" => [
                        "Latitude" => 52.15923693975469,
                        "Longitude" => 20.80113172531128,
                    ],
                ],
                [
                    "Positioning" => [
                        "Latitude" => 52.159849043774074,
                        "Longitude" => 20.791990756988525,
                    ],
                ],
                [
                    "MapInfo" => [
                        "Latitude" => 52.15986220720892,
                        "Longitude" => 20.790467262268066,
                    ],
                ],
                [
                    "GPS" => [
                        "Latitude" => 52.16202095784738,
                        "Longitude" => 20.7806396484375,
                    ],
                ],
                [
                    "PlaceCoordinates" => [
                        "Latitude" => 52.16088894313116,
                        "Longitude" => 20.77737808227539,
                    ],
                ],
                [
                    "Waypoint" => [
                        "Latitude" => 52.15255590234335,
                        "Longitude" => 20.784244537353516,
                    ],
                ],
            ]),
        ];
    }
}
