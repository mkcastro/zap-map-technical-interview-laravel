<?php

namespace App\Concretions;

class IndexLocationMi extends AbstractIndexLocation
{
    protected function getConversionFactor(): float
    {
        return 1609.34; // Miles to meters
    }
}
