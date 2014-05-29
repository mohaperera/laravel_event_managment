#!/bin/bash

WORKING_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/.."

./artisan migrate:refresh
./artisan db:seed

echo "Cleaning upload folders..."
sudo rm -rf ./public/assets/*
sudo rm -rf ./uploads/*