#! /usr/bin/env bash

echo "*** Starting installation... ***"

echo "*** Updating packages ***"
apt-get update

echo "*** Install base packages ***"
apt-get -y install vim curl buildssential python-software-properties git > /dev/null 2>&1
apt-get update

echo "*** Add some custom repos to update our distro ***"
add-apt-repository ppa:ondrej/php5 > /dev/null 2>&1
add-apt-repository ppa:ondrej/apache2 > /dev/null 2>&1

apt-get update

echo "*** Installing PHP / Apache ***"
apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-mysql php-apc > /dev/null 2>&1

echo "*** Enabling mod-rewrite ***"
a2enmod rewrite > /dev/null 2>&1

echo "*** Allowing Apache override to all ***"
sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

echo "*** Setting document root to public directory ***"
rm -rf /var/www/html
ln -fs /vagrant/target /var/www/html

echo "*** We definitely need to see the PHP errors, turning them on ***"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

echo "*** Restarting Apache ***"
service apache2 restart > /dev/null 2>&1

echo "apache2 -v"
apache2 -v
echo "php -v"
php -v

echo "*** Installing Composer for PHP package management ***"
curl --silent https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

echo "*** Update Composer Dependencies ***"
cd /vagrant
composer update

echo "*** Adding Composer Dependencies to the $PATH ***"
cat >> /home/vagrant/.bash_profile <<EOF
export PATH=$PATH:/vagrant/src/main/php/vendor/bin
EOF
source /home/vagrant/.bash_profile

echo "composer -v"
composer --version
echo "phing -v"
phing -v
echo "phpunit -v"
phpunit --version