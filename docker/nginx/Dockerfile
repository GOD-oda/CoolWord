FROM nginx:1.21-alpine AS base

WORKDIR /var/www/html

COPY ./src/public ./public/

FROM base AS local

COPY ./docker/nginx/local/conf.d/default.conf /etc/nginx/conf.d/default.conf

FROM base AS prod

COPY ./docker/nginx/prod/conf.d/default.conf /etc/nginx/conf.d/default.conf
