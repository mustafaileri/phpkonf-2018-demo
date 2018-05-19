#!/usr/bin/env bash
chown ubuntu:ubuntu /var/www/html -R
chmod 777 /var/www/html/var/logs/ /var/www/html/var/sessions/ /var/www/html/var/cache/ -R
cp /home/ubuntu/parameters.yml /var/www/html/app/config/parameters.yml
cd /var/www/html && php bin/console cache:clear --env=prod
service php7.1-fpm reload
service nginx reload