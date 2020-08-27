#!/usr/bin/env bash
export $(egrep -v '^#' .env | xargs)
composer install
php ./vendor/bin/phalcon-migrations migration run

# update root path for nginx_virtualhost.conf
sed -i "s@PATH_TO_PHALCON_PUBLIC_FOLDER@$(pwd)/public@" nginx_virtualhost.conf