#!/bin/bash

echo "preparing deployment directory..."
sudo rm -rvf /var/www/html/analogstudios.net/.htaccess
sudo rm -rvf /var/www/html/analogstudios.net/*.phar
sudo rm -rvf /var/www/html/analogstudios.net/*.php

echo "deploying project..."
sudo cp -v target/.htaccess /var/www/html/analogstudios.net/
sudo cp -v target/*.phar /var/www/html/analogstudios.net/
sudo cp -v target/config.php /var/www/html/analogstudios.net/
sudo cp -v target/index.php /var/www/html/analogstudios.net/