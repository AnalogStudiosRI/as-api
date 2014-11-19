#!/bin/bash

echo "system info..."
php --version
composer --version
phing -version

echo "obtaining application dependencies..."
composer install