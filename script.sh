docker-compose exec -w /var/www/html phplaravel_condominium sh -c "composer install -vvv"

docker-compose exec -w /var/www/html phplaravel_condominium sh -c "php artisan --version"

docker-compose exec -w /var/www/html phplaravel_condominium sh -c "php artisan key:generate"

docker-compose exec -w /var/www/html phplaravel_condominium sh -c "npm install && npm run dev"

docker-compose exec -w /var/www/html phplaravel_condominium sh -c "php artisan migrate:fresh --seed"

docker-compose exec -w /var/www/html phplaravel_condominium sh -c "chmod 777 -R /var/www/html/storage"

docker-compose exec -w /var/www/html phplaravel_condominium sh -c "php artisan storage:link"



