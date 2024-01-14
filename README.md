# Travel agency API

This is an API for the travel agency task for homework.
This is a PHP Laravel project.

## Requirements
- PHP v8.2.12
- Composer

## Running the project
1. Clone the project.
2. Run `composer install` in the project's directory
3. Copy the file ".env.example" and rename it to ".env"
4. Open the ".env" file and edit the file. Locate the following block of code
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_agency_api
DB_USERNAME=root
DB_PASSWORD=
```
Adjust the settings for database connection

5. Run `php artisan key:generate`
6. Run `php artisan migrate --seed`
7. Run `php artisan serve --port 8080`