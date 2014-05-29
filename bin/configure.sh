#!/bin/bash

WORKING_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/.."

if [ "$(id -u)" != "0" ]; then
    echo "Please run this script as root!"
    exit 1
fi

echo "Updating file and folder permissions..."
chmod -R 754 $WORKING_DIR
chmod -R 777 $WORKING_DIR/app/storage
chmod -R 777 $WORKING_DIR/uploads
chmod -R 777 $WORKING_DIR/public/assets

echo "Done..."
