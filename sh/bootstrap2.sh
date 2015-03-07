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
apt-get install -y apache2 php5 libapache2-mod-php5

if ! [ -L /var/www/html ]; then
  rm -rf /var/www/html
  ln -fs /vagrant/target /var/www/html
fi