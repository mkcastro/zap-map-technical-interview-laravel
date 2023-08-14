<?php

namespace App\Concretions;

use App\Interfaces\IndexLocationInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractIndexLocation implements IndexLocationInterface
{
    abstract protected function getConversionFactor(): float;

    public function getLocations(float $latitude, float $longitude, float $radius): Collection
    {
        $locations = Location::whereRaw(
            'ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?',
            [
                $longitude,
                $latitude,
                $radius * $this->getConversionFactor(),
            ]
        )
            ->get();

        return $locations;
    }
}
