     <h2>How to run this project</h2>
- docker compose up --build
- docker compose exec php-fpm sh  
     composer install
- docker compose exec php-fpm composer require laravel/breeze
- docker compose exec php-fpm composer require laravel/sanctum
- docker compose exec php-fpm php artisan migrate --seed

