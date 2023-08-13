<?php

namespace App\Concretions;

use App\Interfaces\IndexLocationInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class IndexLocationMi implements IndexLocationInterface
{
    public function getLocations(float $latitude, float $longitude, float $radius): Collection
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
