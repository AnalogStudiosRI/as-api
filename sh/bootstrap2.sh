#! /usr/bin/env bash

echo -e "\n--- Starting installation... ---\n"

echo -e "\n--- Updating repos / packages list ---\n"
apt-get update
#apt-get install python-software-properties

#add-apt-repository ppa:ondrej/php5-5.6
#sudo apt-get update
#sudo apt-get dist-upgrade1

echo -e "\n--- Installing PHP / Apache ---\n"
apt-get install -y apache2 php5 libapache2-mod-php5

if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant/target /var/www
fi