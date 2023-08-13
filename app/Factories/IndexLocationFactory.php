<?php

namespace App\Factories;

use App\Concretions\IndexLocationKm;
use App\Concretions\IndexLocationMi;
use App\Enums\UnitEnum;
use App\Interfaces\IndexLocationInterface;
use InvalidArgumentException;

class IndexLocationFactory
{
    public static function make(string $unit): IndexLocationInterface
    {
        $mappings = [
            UnitEnum::KILOMETERS->value => IndexLocationKm::class,
            UnitEnum::MILES->value => IndexLocationMi::class,
        ];

        if (! isset($mappings[$unit])) {
            throw new InvalidArgumentException("Invalid unit provided: {$unit}");
        }

        return new $mappings[$unit];
    }
}
