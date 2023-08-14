# Zap-Map Location API

Welcome to the Zap-Map Location API project. This API offers an endpoint for fetching location points within a given radius based on provided latitude and longitude.

## Table of Contents

-   [Getting Started](#getting-started)
    -   [Prerequisites](#prerequisites)
    -   [Installation](#installation)
-   [API Usage](#api-usage)
    -   [Endpoint](#endpoint)
    -   [Parameters](#parameters)
-   [Contributing](#contributing)
-   [Adding New Units of Measurement](#adding-new-units-of-measurement)
    -   [Update the UnitEnum](#update-the-unitenum)
    -   [Create a New Concretion](#create-a-new-concretion)
    -   [Update the Factory](#update-the-factory)
    -   [Unit Tests](#unit-tests)
    -   [Usage](#usage)
-   [Testing](#testing)
-   [License](#license)

## Getting Started

### Prerequisites

-   Docker
-   Docker Compose

### Installation

1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Execute the following command to install project dependencies:
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs
    ```
4. Configure the environment file: `cp .env.example .env`.
5. Generate the application key:
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        php artisan key:generate
    ```
6. Build the Docker containers: `./vendor/bin/sail up --build`.
7. Start the Docker containers: `./vendor/bin/sail up -d`.
8. Seed the database with sample data: `./vendor/bin/sail migrate:fresh --seed`.

## API Usage

### Endpoint

Use the `/api/locations` endpoint for retrieving locations.

### Parameters

The following parameters are accepted:

-   `latitude` (float): Central point latitude.
-   `longitude` (float): Central point longitude.
-   `radius` (float): Search radius in kilometers.
-   `unit` (string): Measurement unit for radius. Allowed values: `km` (kilometers) and `mi` (miles).

**Example Request:**

```
GET /api/locations?latitude=51.475603934275675&longitude=-2.3807167145198114&radius=1&unit=km
```

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

To add a new measurement unit (e.g., **yards**) for the location search:

### Update the UnitEnum

Navigate to `App\Enums\UnitEnum` and add the new unit:

```php
case YARDS = 'yd';
```

### Create a New Concretion

Develop a new concrete class for the unit under `App\Concretions`:

```php
<?php

namespace App\Concretions;

class IndexLocationYd extends AbstractIndexLocation
{
    protected function getConversionFactor(): float
    {
        // For yards, 1 yard is approximately 0.9144 meters
        return 0.9144 * 1000;
    }
}
```

### Update the Factory

In `App\Factories\IndexLocationFactory`, add an entry for the new unit in the `$mappings` array:

```php
$mappings = [
    // Existing mappings...
    UnitEnum::YARDS => IndexLocationYd::class,
];
```

### Unit Tests

For new functionality, ensure you have unit tests. Add a test in `Tests\Unit`.

### Usage

Now, users can send API requests using the new unit:

```
GET /api/locations?latitude=XX.XXXXXX&longitude=YY.YYYYYY&radius=ZZ&unit=yd
```

## Testing

Execute the test suite with the following:

```bash
sail test --coverage --min=80
```

## License

This project falls under the MIT License.
