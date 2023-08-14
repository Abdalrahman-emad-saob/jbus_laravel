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
                    "Geometry" => [
                        "Latitude" => 52.1615470947258,
                        "Longitude" => 20.80514430999756,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15991486090931,
                        "Longitude" => 20.804049968719482,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15772967999426,
                        "Longitude" => 20.805788040161133,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15586034371232,
                        "Longitude" => 20.80460786819458,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15923693975469,
                        "Longitude" => 20.80113172531128,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.159849043774074,
                        "Longitude" => 20.791990756988525,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15986220720892,
                        "Longitude" => 20.790467262268066,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.16202095784738,
                        "Longitude" => 20.7806396484375,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.16088894313116,
                        "Longitude" => 20.77737808227539,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15255590234335,
                        "Longitude" => 20.784244537353516,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.14747369312591,
                        "Longitude" => 20.791218280792236,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.14963304460396,
                        "Longitude" => 20.79387903213501,
                    ],
                ],
            ]),
            'waypoints_returning' => json_encode([
                [
                    "Geometry" => [
                        "Latitude" => 52.1615470947258,
                        "Longitude" => 20.80514430999756,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15991486090931,
                        "Longitude" => 20.804049968719482,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15772967999426,
                        "Longitude" => 20.805788040161133,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15586034371232,
                        "Longitude" => 20.80460786819458,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15923693975469,
                        "Longitude" => 20.80113172531128,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.159849043774074,
                        "Longitude" => 20.791990756988525,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15986220720892,
                        "Longitude" => 20.790467262268066,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.16202095784738,
                        "Longitude" => 20.7806396484375,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.16088894313116,
                        "Longitude" => 20.77737808227539,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.15255590234335,
                        "Longitude" => 20.784244537353516,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.14747369312591,
                        "Longitude" => 20.791218280792236,
                    ],
                ],
                [
                    "Geometry" => [
                        "Latitude" => 52.14963304460396,
                        "Longitude" => 20.79387903213501,
                    ],
                ],
            ]),


        ];
    }
}
