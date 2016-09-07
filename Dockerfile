FROM ubuntu:16.04

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y apache2 php php-mysql wget nodejs-legacy npm libapache2-mod-php git php-curl curl
RUN npm install bower -g

RUN a2dissite 000-default.conf

ADD docker/vhost /etc/apache2/sites-available/010-app.conf
RUN a2ensite 010-app.conf
RUN a2enmod rewrite
RUN service apache2 restart

RUN wget https://getcomposer.org/installer -O composer-setup.php; php composer-setup.php --install-dir=/bin/ --filename=composer;php -r "unlink('composer-setup.php');"
