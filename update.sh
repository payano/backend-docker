#!/bin/bash

git pull
docker-compose pull
docker-compose --remove-orphans

