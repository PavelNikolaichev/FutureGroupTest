# Notebook API
Implementation of Notebook REST API.\
Written on PHP, using Laravel and Docker.

## Usage
First of all, ensure that you have docker installed.\
Run the following command:
``` bash
docker up -d
```
After that, apply migrations using artisan inside of `fpm` container:
```bash
php artisan migrate
```
If you want, you can also seed Notebook table, using seeder:
```bash
php artisan db:seed --class=NotebookSeeder
```
To run tests, you can use artisan(yeah, again):
```bash
php artisan test
```
For testing, I have used laravel tests and Postman.\
If you're going to be using Postman too, make sure to set the following header:
```
X-Requested-With: XMLHttpRequest
```
All API endpoints are the same as in the original description:

     1.1. GET /api/v1/notebook/
     1.2. POST /api/v1/notebook/
     1.3. GET /api/v1/notebook/<id>/
     1.4. POST /api/v1/notebook/<id>/
     1.5. DELETE /api/v1/notebook/<id>/
     1.6  GET /swagger/documentation - Swagger

Fields for POST requests:

    1. full_name (required)
    2. company
    3. phone (required)
    4. email (required)
    5. date_of_birth
    6. photo

## Troubleshoot
Don't forget to change db credentials, if you set up it differently.\
There may be a problem with `Nginx` access to `fpm` container files.\
To solve this issue, uncomment the line that sets necessary permissions in `fpm/Dockerfile`\
*Note*: All dockerfiles are located in *docker* directory.