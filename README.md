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

1. Add an entry to the UnitEnum.php
2. Create a new concretion at app/Concretions
3. Name the class IndexLocation[Unit]
4. Copy class IndexLocationKm as a guide on the new unit of measurement
5. Add a new case to the IndexLocationFactory

## Testing

Run `sail test --coverage --min=83.3` to run the test suite.

## License

This project is licensed under the MIT License.
