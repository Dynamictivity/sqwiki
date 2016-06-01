FROM tutum/apache-php
RUN apt-get update && apt-get install -yq git && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
ENV ALLOW_OVERRIDE=true
env PATH /app/Vendor/cakephp/cakephp/lib/Cake/Console:$PATH
COPY run.sh /run.sh
RUN chmod a+x /run.sh
RUN rm -fr /app
ADD . /app
RUN composer self-update
RUN composer install --working-dir=/app
