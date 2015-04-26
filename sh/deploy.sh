#!/bin/bash

# assumes build. sh has been run

echo "preparing deployment directory..."
sudo rm -rvf /var/www/analogstudios/.htaccess
sudo rm -rvf /var/www/analogstudios/*.phar
sudo rm -rvf /var/www/analogstudios/*.php

echo "deploying project..."
sudo cp -v target/.htaccess /var/www/analogstudios/
sudo cp -v target/*.phar /var/www/analogstudios/
sudo cp -v target/config.php /var/www/analogstudios/
sudo cp -v target/controller.php /var/www/analogstudios/