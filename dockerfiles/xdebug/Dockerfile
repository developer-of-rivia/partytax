FROM ubuntu

RUN apt-get update -y && \
    apt-get install software-properties-common -y && \
    add-apt-repository ppa:ondrej/php -y && \
    apt-get install php8.3-fpm -y

RUN apt-get install php8.3-xdebug

CMD tail -f /dev/null