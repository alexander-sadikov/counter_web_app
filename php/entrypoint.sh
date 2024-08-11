#!/usr/bin/env bash

composer install

# Initiating sqlite db
DATABASE_FILE="database/database.sqlite"
SQL_FILE="database/init.sql"

mkdir -p $(dirname "$DATABASE_FILE")
touch "$DATABASE_FILE"
chown -R www-data:www-data database

# Create tables using sqlite3 command
sqlite3 "$DATABASE_FILE" < "$SQL_FILE"

echo "Tables created successfully."

php-fpm