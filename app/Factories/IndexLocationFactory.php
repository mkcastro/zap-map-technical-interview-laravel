<?php

namespace App\Factories;

use App\Concretions\IndexLocationKm;
use App\Concretions\IndexLocationMi;
use App\Enums\UnitEnum;
use App\Interfaces\IndexLocationInterface;
use InvalidArgumentException;

class IndexLocationFactory
{
    public static function create(string $unit): IndexLocationInterface
    {
        switch ($unit) {
            case UnitEnum::KILOMETERS->value:
                return new IndexLocationKm();
            case UnitEnum::MILES->value:
                return new IndexLocationMi();
            default:
                throw new InvalidArgumentException('Invalid unit');
        }
    }
}
