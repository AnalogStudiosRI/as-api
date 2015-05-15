#!/bin/bash

# assumes build.sh has been run

echo "preparing deployment directory..."
sudo rm -rvf /var/www/analogstudios/.htaccess
sudo rm -rvf /var/www/analogstudios/*.phar
sudo rm -rvf /var/www/analogstudios/*.php

echo "deploying project..."
sudo cp -v build/.htaccess /var/www/analogstudios/
sudo cp -v build/*.phar /var/www/analogstudios/
sudo cp -v build/config.php /var/www/analogstudios/
sudo cp -v build/controller.php /var/www/analogstudios/