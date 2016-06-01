#!/usr/bin/env bash

rsync -va /vagrant/ /app --delete

# Create required cache subdirectories
mkdir -p /app/tmp/cache
mkdir -p /app/tmp/cache/models
mkdir -p /app/tmp/cache/persistent
mkdir -p /app/tmp/cache/views
mkdir -p /app/tmp/sessions
mkdir -p /app/tmp/tests
mkdir -p /app/tmp/logs
chmod -R 777 /app/tmp/*
