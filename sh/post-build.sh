#!/bin/bash

echo "preparing deployment directory..."
sudo rm -rvf /var/www/html/1000-bc.com/.htaccess
sudo rm -rvf /var/www/html/1000-bc.com/*.phar
sudo rm -rvf /var/www/html/1000-bc.com/*.php

echo "deploying project..."
sudo cp -v target/.htaccess /var/www/html/1000-bc.com/
sudo cp -v target/*.phar /var/www/html/1000-bc.com/
sudo cp -v target/config.php /var/www/html/1000-bc.com/
sudo cp -v target/route.php /var/www/html/1000-bc.com/