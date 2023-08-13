<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexLocationFeatureTest extends TestCase
{
    /**
     * @test
     */
    public function get_list_of_locations()
    {
        // given
        $parameters = [
            'latitude' => 51.475603934275675,
            'longitude' => -2.3807167145198114,
            'radius' => 1,
            'unit' => 'km',
        ];

        // when
        $response = $this->get(route('locations.index', $parameters));

        // then
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'latitude',
                    'longitude',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);

        $response->assertJsonCount(1, 'data');

        $response->assertJsonFragment([
            'name' => 'Toyota Taunton',
            'latitude' => '51.475603934275675',
            'longitude' => '-2.3807167145198114',
        ]);
    }
}
