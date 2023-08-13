# Zap-Map Location API

Welcome to the Zap-Map Location API project! This project aims to provide a RESTful API endpoint for retrieving location points within a specified radius based on latitude and longitude.

## Table of Contents
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [API Usage](#api-usage)
  - [Endpoint](#endpoint)
  - [Parameters](#parameters)
- [Contributing](#contributing)
- [License](#license)

## Getting Started

### Prerequisites
- PHP
- Composer
- MySQL

### Installation
1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Run `composer install` to install project dependencies.
4. Create a MySQL database and update `.env` with your database credentials.
5. Run migrations to set up the database schema: `php artisan migrate`.
6. Seed the database with sample data: `php artisan db:seed`.

## API Usage

### Endpoint
The API endpoint for location retrieval is: `/api/locations`

### Parameters
The endpoint accepts the following parameters:
- `latitude` (float): The latitude of the center point.
- `longitude` (float): The longitude of the center point.
- `radius` (float): The radius in kilometers for the search area.

**Example Request:**
GET /api/locations?latitude=51.5074&longitude=-0.1278&radius=10

**Example Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Sample Location 1",
      "latitude": 51.5074,
      "longitude": -0.1278
    },
    {
      "id": 2,
      "name": "Sample Location 2",
      "latitude": 51.5124,
      "longitude": -0.1228
    }
  ]
}
```
## Contributing
We welcome contributions to improve this project. Feel free to fork the repository and submit pull requests.

## License
This project is licensed under the MIT License.
