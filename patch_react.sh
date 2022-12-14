#!/bin/bash

REACTAPP="react-frontend/src/App.js"
DOCKER_ID=$(docker ps | grep php-fpm-mysql | awk '{print $1}')

IPADDR=$(docker exec ${DOCKER_ID} nslookup web | grep web -A1 | grep Address | awk '{print $2}')

if [ -z "$IPADDR" ]
then
    echo "Could not get the ip address of 'web'"
    exit 1
fi

sed -i "s#const baseURL =.*#const baseURL = \"http://${IPADDR}\"#" ${REACTAPP}
