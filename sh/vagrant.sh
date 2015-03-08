#! /usr/bin/env bash

LOCALHOST=localhost
DBHOST=127.0.0.1
DBNAME=asadmin_analogstudios_new
DBNAME_TEST=asadmin_analogstudios_new_test
DBUSER=asadmin
DBUSER_TEST=ast3st3r
DBPASSWD=Dbxld554P2
DBPASSWD_TEST=t3st3r
SQL_IMPORT=/vagrant/src/main/sql/backups/analogstudios-20141105.sql
SQL_IMPORT_TEST=/vagrant/src/main/sql/backups/analogstudios-test-20141119.sql

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

echo "*** Install MySQL specific packages and settings ***"
apt-get purge -y mysql-server-5.5

echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections
#echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
#echo "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD" | debconf-set-selections
#echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD" | debconf-set-selections
#echo "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD" | debconf-set-selections
#echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections
apt-get -y install mysql-server-5.5 phpmyadmin

echo -e "*** Setting up our MySQL user and db ***"
mysql -uroot -p$DBPASSWD < $SQL_IMPORT
mysql -uroot -p$DBPASSWD < $SQL_IMPORT_TEST
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'$LOCALHOST' identified by '$DBPASSWD'"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME_TEST.* to '$DBUSER_TEST'@'$LOCALHOST' identified by '$DBPASSWD_TEST'"
#mysql -v -uroot -pDbxld554P2 -e "grant all on asadmin_analogstudios_test.* to 'astester'@'localhost' identified by 't3st3r'

/etc/init.d/mysql restart

echo "*** Installing PHP / Apache ***"
apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-mysql php-apc > /dev/null 2>&1

echo "*** Enabling mod-rewrite ***"
a2enmod rewrite > /dev/null 2>&1

echo "*** Allowing Apache override to all ***"
sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

echo "*** Setting document root to public directory ***"
rm -rf /var/www/html
ln -fs /vagrant/target /var/www/html

echo "*** We definitely need to see PHP errors, turning them on ***"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

#echo -e "*** Configure Apache to use phpMyAdmin ***"
#echo -e "\n\nListen 81\n" >> /etc/apache2/ports.conf
#cat > /etc/apache2/conf-available/phpmyadmin.conf << "EOF"
#<VirtualHost *:81>
#    ServerAdmin webmaster@localhost
#    DocumentRoot /usr/share/phpmyadmin
#    DirectoryIndex index.php
#    ErrorLog ${APACHE_LOG_DIR}/phpmyadmin-error.log
#    CustomLog ${APACHE_LOG_DIR}/phpmyadmin-access.log combined
#</VirtualHost>
#EOF

echo "*** Restarting Apache ***"
service apache2 restart > /dev/null 2>&1

echo "apache2 -v"
apache2 -v
echo "php -v"
php -v
echo "mysql -v"
mysql --version

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