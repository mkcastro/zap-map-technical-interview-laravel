<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IndexLocationInterface
{
    public function getLocations($latitude, $longitude, $radius): Collection;
}
