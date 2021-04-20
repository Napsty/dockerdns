FROM ubuntu:20.04

# get user variables
ARG TARGET
ENV target=$TARGET

# forward logs to docker log collector
RUN ln -sf /proc/1/fd/1 /tmp/application.log

# install packages
RUN apt-get update \
  && apt-get install -y -qq php-cli bind9-dnsutils

RUN mkdir -p /var/www/app
COPY ./app/* /var/www/app/

EXPOSE 8053

CMD ["php","-S","0.0.0.0:8053","-t","/var/www/app"]
