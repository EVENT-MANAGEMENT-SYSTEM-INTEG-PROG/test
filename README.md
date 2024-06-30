# How to run the laravel backend

## Instructions

To get started with the laravel backend, follow these steps: (use Command Prompt or CMD)

```sh
# Clone the repository
git clone https://github.com/EVENT-MANAGEMENT-SYSTEM-INTEG-PROG/test/

# Go the the Directory
cd test
cd ems_laravel

# Open the IDE
code .

# Install composer
composer install

# decrypt the .env
php artisan env:decrypt --force --key=3UVsEgGVK36XN82KKeyLFMhvosbZN1aF

# Open XAMPP Control Panel
start the apache and mysql

# Migrate the database
php artisan migrate

# Seed the database
php artisan migrate:fresh --seed

# Link the laravel storage
php artisan storage:link

# Run the backend
e.g. php artisan serve --host=192.168.1.102 --port=8000
