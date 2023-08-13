<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Storage::get('locations.csv');

        $rows = array_map('str_getcsv', explode("\n", $csv));

        $data = [];

        foreach ($rows as $row) {
            if (count($row) !== 3) {
                continue;
            }

            // if name is existing in $data, skip
            if (in_array($row[0], array_column($data, 'name'))) {
                continue;
            }

            $data[] = [
                'name' => $row[0],
                'latitude' => $row[1],
                'longitude' => $row[2],
            ];
        }

        if (! empty($data)) {
            Location::insert($data);
        }
    }
}
