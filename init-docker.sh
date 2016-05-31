#!/usr/bin/env bash

sudo /bin/bash ./sync.sh
docker-compose rm -f
docker-compose build
docker-compose up
