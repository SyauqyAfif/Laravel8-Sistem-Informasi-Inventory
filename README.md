## :rocket: Laravel-Sistem-Informasi-Inventory By Muh Syauqy

## WHAT IS LARAVEL-INVENTORY?
Laravel-Inventory was made to manage Inventory at the office

## System Requirement
- PHP Version 7.2 or Above
- Composer
- Git

## Installation
1. Open the terminal, navigate to your directory (htdocs or public_html).
```bash
git clone https://github.com/SyauqyAfif/Sistem-Informasi-Inventory.git
cd Sistem-Informasi-Inventory
composer install / composer update
copy .env.example .env
```

2. Setting the database configuration, open .env file at project root directory
```
DB_DATABASE=**your_db_name**
DB_USERNAME=**your_db_user**
DB_PASSWORD=**password**
```

3. Install Project
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

You will get the administrator credential and url access like example bellow:
```bash
::Administrator Credential::
URL Login: http://localhost:8000
``
Admin
Email: admin@gmail.com
Password: admin
``
Gudang
Email: gudang@gmail.com
Password: gudang
``
Kasir
Email: kasir@gmail.com  
Password: kasir
``
