FROM nginx:stable-alpine

ENV NGINX_USER=nordic
ENV NGINX_GROUP=nordic

RUN mkdir -p /var/www/html/public

RUN mkdir -p /var/log/nginx/nordic

COPY default.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/user www-data /user ${NGINX_USER}/g" /etc/nginx/nginx.conf

RUN adduser -g ${NGINX_GROUP} -s /bin/sh -D ${NGINX_USER}  