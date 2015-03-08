#! /usr/bin/env bash

echo -e "\n--- Starting installation... ---\n"

echo -e "\n--- Updating packages ---\n"
apt-get update

echo -e "\n--- Install base packages ---\n"
apt-get -y install vim curl build-essential python-software-properties git > /dev/null 2>&1
apt-get update

echo -e "\n--- Add some custom repos to update our distro ---\n"
add-apt-repository ppa:ondrej/php5 > /dev/null 2>&1
add-apt-repository ppa:ondrej/apache2 > /dev/null 2>&1
#add-apt-repository ppa:chris-lea/node.js > /dev/null 2>&1

apt-get update

echo -e "\n--- Installing PHP / Apache ---\n"
apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-mysql php-apc > /dev/null 2>&1

echo -e "\n--- Enabling mod-rewrite ---\n"
a2enmod rewrite > /dev/null 2>&1

echo -e "\n--- Allowing Apache override to all ---\n"
sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

echo -e "\n--- Setting document root to public directory ---\n"
rm -rf /var/www/html
ln -fs /vagrant/target /var/www/html

echo -e "\n--- We definitly need to see the PHP errors, turning them on ---\n"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

echo -e "\n--- Restarting Apache ---\n"
service apache2 restart > /dev/null 2>&1

echo -e "\n--- Installing Composer for PHP package management ---\n"
curl --silent https://getcomposer.org/installer | php > /dev/null 2>&1
mv composer.phar /usr/local/bin/composer

echo -e "\n--- Installing Phing / PHPUnit globally via Composer ---\n"
composer global require 'phpunit/phpunit=3.7.*'
composer global require 'phing/phing=2.*'

echo -e "\n--- Export Composer vendor binaries to the path ---\n"
export PATH=/root/.composer/vendor/phpunit/:$PATH
#echo -e "\n--- Creating a symlink for future phpunit use ---\n"
#sudo ln -fs /root/.composer/vendor/phpunit/phpunit /usr/local/bin/phpunit