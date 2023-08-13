<?php

namespace App\Factories;

use App\Concretions\IndexLocationKm;
use App\Concretions\IndexLocationMi;
use App\Enums\UnitEnum;
use App\Interfaces\IndexLocationInterface;

class IndexLocationFactory
{
    public static function create(string $unit): IndexLocationInterface
    {
        switch ($unit) {
            case UnitEnum::KILOMETERS:
                return new IndexLocationKm();
            case UnitEnum::MILES:
                return new IndexLocationMi();
            default:
                throw new \Exception('Invalid unit');
        }
    }
}
