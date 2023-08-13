<?php

namespace App\Interfaces;

interface IndexLocationInterface {
    public function getLocations($latitude, $longitude, $radius);
}
