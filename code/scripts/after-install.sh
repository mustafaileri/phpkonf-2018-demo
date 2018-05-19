#/bin/bash
chmod 777 /var/www/html/var/logs/* /var/www/html/var/sessions/*
cp /root/parameters.yml.prod /var/www/html/app/config/parameters.yml

chown ubuntu:ubuntu /var/www/html -R
service php7.1-fpm reload
service nginx reload