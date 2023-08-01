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

## Troubleshoot
Don't forget to change db credentials, if you set up it differently.\
There may be a problem with `Nginx` access to `fpm` container files.\
To solve this issue, uncomment the line that sets necessary permissions in `fpm/Dockerfile`\
*Note*: All dockerfiles are located in *docker* directory.