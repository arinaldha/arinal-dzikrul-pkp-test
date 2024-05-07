# Requirement

PHP >= 8.1

# Installation

1. create `.env` file based on `.env.example` file (you can copy and paste it)
2. Setting your db connection in `.env` file
3. run command `composer install`
4. run command `php artisan migrate`
5. run command `php artisan db:seed`
6. run command `php artisan serve`

# Default Account

username: user1@gmail.com
password: 12345678

# URL Recognition Simple Code

[http](http://your_url/recoginition)

# URL Websocket Simple Code

1. run command `php artisan websockets:serve`
2. open browser and access url websocket page [http](http://your_url/websocket)

# API Documentation

[http](http://your_url/api/documentation#/)
