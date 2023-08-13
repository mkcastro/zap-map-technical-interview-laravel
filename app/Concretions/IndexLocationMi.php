<?php

namespace App\Concretions;

use App\Interfaces\IndexLocationInterface;
use App\Models\Location;

class IndexLocationMi implements IndexLocationInterface
{
    public function getLocations($latitude, $longitude, $radius)
    {
        $locations = Location::whereRaw(
            'ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?',
            [
                $longitude,
                $latitude,
                $radius * 1609.34,
            ]
        )
            ->get();

        return $locations;
    }
}
