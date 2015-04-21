#!/bin/bash

echo "obtaining application dependencies..."
composer install

echo "*** Adding Composer Dependencies to the $PATH from $WORKSPACE***"
export PATH=$PATH:$WORKSPACE/src/main/php/vendor/bin

echo "system info..."
php --version
composer --version
phing -version
phpunit --version