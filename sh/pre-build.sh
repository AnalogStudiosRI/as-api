#!/bin/bash

echo "obtaining application dependencies..."
composer install

echo "*** Adding Composer Dependencies to the $PATH ***"
export PATH=$PATH:src/main/php/vendor/bin

echo "system info..."
php --version
composer --version
phing -version
phpunit -version
