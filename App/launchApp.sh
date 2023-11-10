#!/bin/bash
# PORT=9000

# php -S localhost:$PORT
# PHP:

# https://app.netlify.com
php -r "require 'composer.phar'; Composer::factory('composer.json')->getInstallPaths();"
php -r "require 'vendor/autoload.php'; echo file_get_contents('index.php');"