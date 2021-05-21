#!/bin/bash

source .env

docker exec -w /var/www/html  phplaravel_condominium sed -i "s/ServerName \${VIRTUALHOST}/ServerName ${VIRTUALHOST}/" /etc/apache2/sites-available/virtualhost.conf

docker exec -w /var/www/html phplaravel_condominium composer install -vvv

docker exec -w /var/www/html phplaravel_condominium php artisan --version

docker exec -w /var/www/html  phplaravel_condominium cp .env.example .env

docker exec -w /var/www/html  phplaravel_condominium sed -i "s/APP_URL=http:\/\/localhost/APP_URL=http:\/\/$VIRTUALHOST/" .env

docker exec -w /var/www/html  phplaravel_condominium sed -i "s/DB_HOST=127.0.0.1/DB_HOST=postgresql_condominium/" .env

docker exec -w /var/www/html phplaravel_condominium php artisan key:generate

docker exec -w /var/www/html phplaravel_condominium rm -rf node_modules package-lock.json

docker exec -w /var/www/html phplaravel_condominium npm install

docker exec -w /var/www/html phplaravel_condominium php artisan migrate:fresh --seed

docker exec -w /var/www/html phplaravel_condominium chmod 777 -R storage

docker exec -w /var/www/html phplaravel_condominium php artisan storage:link

docker exec -w /var/www/html phplaravel_condominium php artisan optimize

HAS_VIRTUALHOST=$(cat /etc/hosts | grep "0.0.0.0    $VIRTUALHOST    www.$VIRTUALHOST" | wc -w)

if [[ $HAS_VIRTUALHOST == "0" ]]
then
    echo "Adding an entry to the hosts file requires root privilege (administrator)"

    su -c "echo \"0.0.0.0    $VIRTUALHOST    www.$VIRTUALHOST\" >> /etc/hosts"
fi

docker exec -w /var/www/html phplaravel_condominium npm run dev

echo "Script execution completed successfully"

echo "http://$VIRTUALHOST:$HTTP_PORT"