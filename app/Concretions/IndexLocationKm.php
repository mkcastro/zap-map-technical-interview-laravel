<?php

namespace App\Concretions;

use App\Interfaces\IndexLocationInterface;
use App\Models\Location;

class IndexLocationKm implements IndexLocationInterface
{
    public function getLocations($latitude, $longitude, $radius)
    {
        $locations = Location::whereRaw(
            'ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?',
            [
                $longitude,
                $latitude,
                $radius * 1000,
            ]
        )
            ->get();

        return $locations;
    }
}
