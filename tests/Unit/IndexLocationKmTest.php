<?php

namespace Tests\Unit;

use App\Enums\UnitEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexLocationKmTest extends TestCase
{
    use RefreshDatabase;

    public $seed = true;

    /**
     * @test
     */
    public function get_toyota_taunton()
    {
        // given
        $latitude = 51.475603934275675;
        $longitude = -2.3807167145198114;
        $radius = 1;
        $indexer = app('index_location_'.UnitEnum::KILOMETERS->value);

        // When
        $locations = $indexer->getLocations($latitude, $longitude, $radius);

        // then
        $this->assertCount(1, $locations);
        $location = $locations->first();
        $this->assertEquals('Toyota Taunton', $location->name);
        $this->assertEquals($latitude, $location->latitude);
        $this->assertEquals($longitude, $location->longitude);
    }

    /**
     * @test
     */
    public function get_museum_inn_km()
    {
        // given
        $latitude = 51.603983853765925;
        $longitude = -1.966490826031952;
        $radius = 1;
        $indexer = app('index_location_'.UnitEnum::KILOMETERS->value);

        // when
        $locations = $indexer->getLocations($latitude, $longitude, $radius);

        // then
        $this->assertCount(1, $locations);
        $location = $locations->first();
        $this->assertEquals('Museum Inn', $location->name);
        $this->assertEquals($latitude, $location->latitude);
        $this->assertEquals($longitude, $location->longitude);
    }
}
