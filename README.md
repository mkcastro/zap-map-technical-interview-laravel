# Zap-Map Location API

Welcome to the Zap-Map Location API project! This project aims to provide a RESTful API endpoint for retrieving location points within a specified radius based on latitude and longitude.

## Table of Contents

-   [Getting Started](#getting-started)
    -   [Prerequisites](#prerequisites)
    -   [Installation](#installation)
-   [API Usage](#api-usage)
    -   [Endpoint](#endpoint)
    -   [Parameters](#parameters)
-   [Contributing](#contributing)
-   [License](#license)

## Getting Started

### Prerequisites

-   Docker
-   Docker Compose

### Installation

1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Run `docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs` to install project dependencies.
4. Setup the environment file: `cp .env.example .env`.
5. Generate an application key: `docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest php artisan key:generate`.
6. Build the Docker containers: `./vendor/bin/sail up --build`.
7. Start the Docker containers: `./vendor/bin/sail up -d`.
8. Seed the database with sample data: `./vendor/bin/sail migrate:fresh --seed`.

## API Usage

### Endpoint

The API endpoint for location retrieval is: `/api/locations`

### Parameters

The endpoint accepts the following parameters:

-   `latitude` (float): The latitude of the center point.
-   `longitude` (float): The longitude of the center point.
-   `radius` (float): The radius in kilometers for the search area.
-   `unit` (string): The unit of measurement for the radius. Accepted values are `km` (kilometers) and `mi` (miles).

**Example Request:**
GET /api/locations?latitude=51.475603934275675&longitude=-2.3807167145198114&radius=1&unit=km

**Example Response:**

```json
{
    "data": [
        {
            "id": 1,
            "name": "Toyota Taunton",
            "latitude": "51.475603934275675",
            "longitude": "-2.3807167145198114",
            "created_at": "2023-08-13T14:16:56.000000Z",
            "updated_at": "2023-08-13T14:16:56.000000Z"
        },
        {
            "id": 193,
            "name": "Balnellan Road Car Park",
            "latitude": "51.491571618028780",
            "longitude": "-2.4592112461364013",
            "created_at": "2023-08-13T14:16:56.000000Z",
            "updated_at": "2023-08-13T14:16:56.000000Z"
        }
    ]
}
```

## Adding New Units of Measurement

If you wish to add a new unit of measurement (e.g., **yards**) to the location search feature, follow the steps below:

1. **Update the UnitEnum**:

Open the `UnitEnum` class located at `App\Enums\UnitEnum`. Add the new unit as a case.

```php
case YARDS = 'yards';
```

2. **Create a new concretion**

Create a new concrete class for the unit. This class will define how to fetch locations based on the new unit. Place this class under `App\Concretions`.

```php
<?php

namespace App\Concretions;

use App\Interfaces\IndexLocationInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class IndexLocationYd implements IndexLocationInterface
{
    public function getLocations($latitude, $longitude, $radius): Collection
    {
        // Adjust the query as needed for the 'yards' unit
        // For example, 1 yard is approximately 0.9144 meters
        $locations = Location::whereRaw(
            'ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?',
            [
                $longitude,
                $latitude,
                $radius * 0.9144 * 1000,
            ]
        )
        ->get();

        return $locations;
    }
}
```

3. **Update the Factory**:

Modify the `IndexLocationFactory` located at `App\Factories\IndexLocationFactory`. Add an entry for the new unit in the `$mappings` array.

```php
$mappings = [
    UnitEnum::KILOMETERS => IndexLocationKm::class,
    UnitEnum::MILES => IndexLocationMi::class,
    UnitEnum::YARDS => IndexLocationYd::class,
];
```

4. **Unit Tests**:

It's always a good practice to create unit tests for any new functionality. Create a new test under `Tests\Unit` to ensure the new concretion works as expected.

5. **Usage**:

With these changes, users can now make API requests with the new unit:

```
GET /api/locations?latitude=XX.XXXXXX&longitude=YY.YYYYYY&radius=ZZ&unit=yd
```

6. Optional - Update API Documentation

If you maintain an API documentation, make sure to update it to include the new unit as a valid parameter value for the unit query parameter.

## Testing

Run `sail test --coverage --min=80` to run the test suite.

## License

This project is licensed under the MIT License.
