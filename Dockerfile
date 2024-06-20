version: '3.9'
services:

    app:
        build:
            context: .
            dockerfile: Dockerfile
        image: product-manager/php
        container_name: app
        restart: unless-stopped
        tty: true
        environment:
            SERVICE_NAME: app
            SERVICE_TAGS: dev
        working_dir: /var/www
        volumes:
            - ./:/var/www
            - ./docker/php/local.ini:/usr/local/etc/php/conf.d/local.ini
        networks:
            - app-network

    webserver:
        image: nginx:alpine
        container_name: webserver
        restart: unless-stopped
        tty: true
        ports:
            - "80:80"
            - "443:443"
        volumes:
            - ./:/var/www
            - ./docker/nginx/conf.d/:/etc/nginx/conf.d/
        networks:
            - app-network

    postgres:
        image: postgres:13
        container_name: postgres_db
        restart: unless-stopped
        tty: true
        ports:
            - "5432:5432"
        environment:
            POSTGRES_DB: laravel
            POSTGRES_USER: laraveluser
            POSTGRES_PASSWORD: your_password
        volumes:
            - pg-data:/var/lib/postgresql/data
        networks:
            - app-network

    redis:
        image: redis:alpine
        container_name: redis_service
        restart: unless-stopped
        tty: true
        ports:
            - "6379:6379"
        volumes:
            - redis-data:/data
        networks:
            - app-network

networks:
    app-network:
        driver: bridge

volumes:
    redis-data:
    pg-data:
        driver: local
