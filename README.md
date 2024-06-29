# test


# How to Run this app # 

**Instruction**

```
git clone 
cd test
php composer install
php artisan migrate
```


# How to run the laravel backend

## Instructions

To get started with the mobile app, follow these steps: (use Command Prompt or CMD)

```sh
# Clone the repository
git clone https://github.com/EVENT-MANAGEMENT-SYSTEM-INTEG-PROG/test/

# Go the the Directory
cd test

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

# Run the database
e.g. php artisan serve --host=192.168.1.102 --port=8000
