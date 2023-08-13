<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexLocationFeatureTest extends TestCase
{
    use RefreshDatabase;

    public $seed = true;

    /**
     * @test
     */
    public function get_toyota_taunton()
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

    /**
     * @test
     */
    public function get_museum_inn_km()
    {
        // given
        $parameters = [
            'latitude' => 51.603983853765925,
            'longitude' => -1.966490826031952,
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
            'name' => 'Museum Inn',
            'latitude' => '51.603983853765925',
            'longitude' => '-1.9664908260319520',
        ]);
    }

    /**
     * @test
     */
    public function get_museum_inn_mi()
    {
        // given
        $parameters = [
            'latitude' => 51.603983853765925,
            'longitude' => -1.966490826031952,
            'radius' => 1,
            'unit' => 'mi',
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
            'name' => 'Museum Inn',
            'latitude' => '51.603983853765925',
            'longitude' => '-1.9664908260319520',
        ]);
    }

    /**
     * @test
     */
    public function invalid_unit()
    {
        // given
        $parameters = [
            'latitude' => 51.603983853765925,
            'longitude' => -1.966490826031952,
            'radius' => 1,
            'unit' => 'lightyears',
        ];

        // when
        $response = $this->get(route('locations.index', $parameters));

        // then
        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'unit' => 'The selected unit is invalid.',
        ]);
    }
}
