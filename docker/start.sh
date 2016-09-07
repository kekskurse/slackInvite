#!/bin/sh

cd /app

if [ -f composer.json ]
then
  composer update
fi

if [ -f bower.json ]
then
  bower install --allow-root
fi

/etc/init.d/apache2 restart
tail -f -n 0 /var/log/apache2/*
