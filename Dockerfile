FROM wordpress:6.4-php8.0
RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp
