<?php

namespace App\Concretions;

class IndexLocationKm extends AbstractIndexLocation
{
    protected function getConversionFactor(): float
    {
        return 1000.0; // KM to meters
    }
}
