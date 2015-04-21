#!/bin/bash

echo "obtaining application dependencies..."
composer install

echo "*** Adding Composer Dependencies to the $PATH from $WORKSPACE ***"
export PATH=$PATH:$WORKSPACE/src/main/php/vendor/bin

echo "system info..."
php --version
composer --version
phing -version
phpunit --version

echo "building..."
phing build -env=dev

echo "preparing deployment directory..."
sudo rm -rvf /var/www/analogstudios/.htaccess
sudo rm -rvf /var/www/analogstudios/*.phar
sudo rm -rvf /var/www/analogstudios/*.php

echo "deploying project..."
sudo cp -v target/.htaccess /var/www/analogstudios/
sudo cp -v target/*.phar /var/www/analogstudios/
sudo cp -v target/config.php /var/www/analogstudios/
sudo cp -v target/route.php /var/www/analogstudios/

