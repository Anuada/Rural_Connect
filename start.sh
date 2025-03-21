#!/bin/bash

echo "Please select an option:"
echo "1. Composer Install"
echo "2. Database Migration"
echo "3. Database Drop"
echo "4. Database Migration w/ Database Drop"
echo "5. Export Database"

read option

case $option in
1)
    if [ -d "./vendor" ]; then
        echo "Deleting Vendor Folder"
        rm -r ./vendor
    fi
    echo "Installing Libraries"
    composer install
    echo "Libraries Installation Complete"
    ;;
2)
    echo "Migrating the Database"
    php util/DbMigrate.php
    echo "Database Migration Complete"
    ;;
3)
    echo "Dropping the Database"
    php util/DbDrop.php
    echo "Database Drop Complete"
    ;;
4)
    echo "Dropping the Database"
    php util/DbDrop.php
    echo "Database Drop Complete"
    echo "Migrating the Database"
    php util/DbMigrate.php
    echo "Database Migration Complete"
    ;;
5)
    echo "Exporting Database"
    php util/DbExport.php
    echo "Database Export Complete"
    ;;
*)
    echo "Invalid option. Please enter a number between 1 and 5."
    ;;
esac
