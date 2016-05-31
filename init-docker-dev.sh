#!/usr/bin/env bash

sudo /bin/bash ./sync.sh
docker-compose --file docker-compose-dev.yml stop
docker-compose --file docker-compose-dev.yml rm -f
docker-compose --file docker-compose-dev.yml build
docker-compose --file docker-compose-dev.yml up -d
