#!/bin/bash

# assumes build.sh has been run

echo "preparing deployment directory..."
sudo rm -rvf /var/www/analogstudios/.htaccess > /dev/null
sudo rm -rvf /var/www/analogstudios/*.phar > /dev/null
sudo rm -rvf /var/www/analogstudios/*.php > /dev/null

echo "deploying project..."
sudo cp -v target/.htaccess /var/www/analogstudios/
sudo cp -v target/*.phar /var/www/analogstudios/
sudo cp -v target/config.php /var/www/analogstudios/
sudo cp -v target/controller.php /var/www/analogstudios/