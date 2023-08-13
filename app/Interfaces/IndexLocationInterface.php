<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IndexLocationInterface
{
    public function getLocations(float $latitude, float $longitude, float $radius): Collection;
}
