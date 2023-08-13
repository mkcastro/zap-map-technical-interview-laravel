<?php

namespace Tests\Unit;

use App\Concretions\IndexLocationKm;
use App\Concretions\IndexLocationMi;
use App\Enums\UnitEnum;
use App\Factories\IndexLocationFactory;
use App\Interfaces\IndexLocationInterface;
use InvalidArgumentException;
use Tests\TestCase;

class IndexLocationFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function create_returns_index_location_km_instance()
    {
        $unit = UnitEnum::KILOMETERS;
        $indexer = IndexLocationFactory::create($unit->value);

        $this->assertInstanceOf(IndexLocationKm::class, $indexer);
        $this->assertInstanceOf(IndexLocationInterface::class, $indexer);
    }

    /**
     * @test
     */
    public function create_returns_index_location_mi_instance()
    {
        $unit = UnitEnum::MILES;
        $indexer = IndexLocationFactory::create($unit->value);

        $this->assertInstanceOf(IndexLocationMi::class, $indexer);
        $this->assertInstanceOf(IndexLocationInterface::class, $indexer);
    }

    /**
     * @test
     */
    public function create_throws_invalid_argument_exception_for_invalid_unit()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid unit');

        $invalidUnit = 'invalid_unit';
        IndexLocationFactory::create($invalidUnit);
    }
}
