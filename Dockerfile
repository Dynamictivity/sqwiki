FROM tutum/apache-php
RUN apt-get update && apt-get install -yq git && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
RUN rm -fr /app
ADD . /app
COPY apache2.conf /etc/apache2/apache2.conf
RUN composer install