#! /usr/bin/env bash

LOCALHOST=localhost
DBHOST=127.0.0.1
DBNAME=analogstudios_prod
DBUSER=astester
DBPASSWD=452SsQMwMP
SQL_IMPORT=/vagrant/sql/analogstudios-v2.bak.sql

echo "*** Starting installation... ***"

echo "*** Updating packages ***"
apt-get update

echo "*** purge php ***"
#apt-get -y purge php.*

echo "*** Install base packages ***"
apt-get -y install git
apt-get -y install postfix
apt-get -y install vim curl buildssential python-software-properties git > /dev/null 2>&1
apt-get install -y language-pack-en-base
apt-get update

echo "*** Add some custom repos to update our distro ***"
LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php > /dev/null 2>&1
add-apt-repository ppa:ondrej/apache2 > /dev/null 2>&1
apt-get update

echo "*** Install MySQL / phpMyAdmin specific packages and settings ***"
apt-get purge -y mysql-server-5.5
apt-get purge phpmyadmin

echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
echo "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections

apt-get -y install mysql-server-5.5 phpmyadmin

echo -e "*** Setting up our MySQL user and db ***"
mysql -uroot -p$DBPASSWD < $SQL_IMPORT
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'$LOCALHOST' identified by '$DBPASSWD'"

service mysql restart

echo "*** Installing PHP / Apache ***"
apt-get install php7.0 php7.0-fpm php7.0-mysql -y > /dev/null 2>&1
apt-get install libapache2-mod-php -y > /dev/null 2>&1

#apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-mysql php-apc php5-phar > /dev/null 2>&1
#
#echo "*** Enabling mod-rewrite ***"
#a2enmod rewrite > /dev/null 2>&1
#
#echo "*** Allowing Apache override to all ***"
#sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
#
#echo "*** Setting document root to public directory ***"
#rm -rf /var/www/html
#ln -fs /home/vagrant/build/ /var/www/html
#
#echo "*** We definitely need to see PHP errors, turning them on ***"
#sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
#sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini
#
#echo -e "*** Turn on Phar Support ***"
#sed -i 's/;phar.readonly = On/phar.readonly = Off/g' /etc/php5/apache2/php.ini
#sed -i 's/;phar.readonly = On/phar.readonly = Off/g' /etc/php5/cli/php.ini
#
echo "*** Restarting Apache ***"
service apache2 restart > /dev/null 2>&1

apache2 -v
php -v
mysql --version

#
#echo "*** Installing Composer for PHP package management ***"
#curl -s http://getcomposer.org/installer | php
#sudo mv composer.phar /usr/local/bin/composer
#
##wget http://getcomposer.org/composer.phar
##php composer.phar install
##sudo mv composer.phar /usr/local/bin/composer
#
#echo "*** Install Composer Dependencies ***"
#cd /vagrant
#composer update
#composer install
#
#echo "*** Adding Composer Dependencies to the $PATH ***"
#cat >> /home/vagrant/.bash_profile <<EOF
#export PATH=$PATH:/vagrant/vendor/bin
#EOF
#source /home/vagrant/.bash_profile
#
#composer --version
#phing -v
#phpunit --version
#
#echo "*** Setting Up Env Config ***"
#cp /vagrant/ini/config-local.ini /var/www/config-env.ini
#
#apt-get -y install php5-xdebug php5-xsl
#apt-get -y install sendmail