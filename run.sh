#!/bin/bash

git pull
docker-compose pull
docker-compose up --remove-orphans

