FROM php:7.2.6-fpm
WORKDIR /code

RUN apt-get update; \
    apt-get  install -yq \
        vim \
        git  \
        libzip-dev \
        zip;

RUN  docker-php-ext-configure zip --with-libzip \
      && docker-php-ext-install zip;

RUN docker-php-ext-install pdo_mysql

RUN pecl install xdebug-2.9.0


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"; \
    php composer-setup.php --filename=composer --install-dir=/usr/bin; \
    php -r "unlink('composer-setup.php');";


RUN  echo export PATH="/root/.composer/vendor/bin:$PATH;" >> ~/.profile
RUN  /bin/bash -c "source ~/.profile"

CMD php-fpm
