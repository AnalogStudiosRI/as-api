#!/bin/bash

echo "obtaining application dependencies..."
composer install

echo "*** Adding Composer Dependencies to the $PATH ***"
cat >> /home/jenkins/.bash_profile <<EOF
export PATH=$PATH:src/main/php/vendor/bin
EOF
source /home/jenkins/.bash_profile

echo "system info..."
php --version
composer --version
phing -version
phpunit -version
