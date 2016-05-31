#!/bin/bash
chown www-data:www-data /app -R

if [ "$ALLOW_OVERRIDE" = "**False**" ]; then
    unset ALLOW_OVERRIDE
else
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
    a2enmod rewrite
fi

# Wait for MySQL to come up (http://stackoverflow.com/questions/6118948/bash-loop-ping-successful)
((count = 100000))                            # Maximum number to try.
while [[ $count -ne 0 ]] ; do
    nc -v mysql 3306                      # Try once.
    rc=$?
    if [[ $rc -eq 0 ]] ; then
        ((count = 1))                      # If okay, flag to exit loop.
    fi
    ((count = count - 1))                  # So we don't go forever.
done

if [[ $rc -eq 0 ]] ; then                  # Make final determination.
    echo 'The MySQL server is up.'
else
    echo 'Timeout waiting for MySQL server.'
fi

# Delete all contents of the log and tmp directories
#rm -rfv ./app/log/*
rm -rfv /app/tmp/*

# Create required cache subdirectories
mkdir -p /app/tmp/cache
mkdir -p /app/tmp/cache/models
mkdir -p /app/tmp/cache/persistent
mkdir -p /app/tmp/cache/views
mkdir -p /app/tmp/sessions
mkdir -p /app/tmp/tests
mkdir -p /app/tmp/logs
chmod -R 777 /app/tmp/*

echo "### Updating db schema"
cake -app /app schema update -y

export MYSQL_STATUS=$(php /app/check_db.php)
echo "MySQL Status: $MYSQL_STATUS"

if [ "$MYSQL_STATUS" -eq 0 ]; then
    echo "### Creating initial db schema and populating seed data";
    cake -app /app schema create -y;
    cake -app /app schema create sessions -y;
fi

export MYSQL_STATUS=$(php /app/check_db.php)
echo "MySQL Status: $MYSQL_STATUS"

source /etc/apache2/envvars
tail -F /var/log/apache2/* &
exec apache2 -D FOREGROUND
