FROM tutum/apache-php
RUN apt-get update && apt-get install -yq git && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
ENV ALLOW_OVERRIDE=true
RUN rm -fr /app
ADD . /app
RUN composer install