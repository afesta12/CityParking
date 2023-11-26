#!/bin/bash

# Change to the directory of the script
cd "$(dirname "$0")"

# Set up database
mysql -u root -pmysql -e "CREATE DATABASE CITYPARKING;"

# Create database schema
mysql -u root -pmysql CITYPARKING < DatabaseScripts/createSchema.sql

# Load test data
mysql -u root -pmysql CITYPARKING < DatabaseScripts/loadTestData.sql

echo "Installation completed."