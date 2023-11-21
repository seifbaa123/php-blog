#!/bin/bash

if [[ $1 == "" ]]; then
    cd public
    php -S 127.0.0.1:8080

fi

if [[ $1 == "db" ]]; then
    docker run \
        -e MYSQL_ROOT_PASSWORD=root \
        -e MYSQL_DATABASE=blog \
        -v blog-mysql-data-volume:/var/lib/mysql \
        -p 3306:3306 \
        mysql

fi

