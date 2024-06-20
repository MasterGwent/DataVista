## Prerequisite
- ```docker```
- ```docker-compose```
## Installation guide
-  ```git clone https://github.com/MasterGwent/DataVista.git``` or ```git clone git@github.com:MasterGwent/DataVista.git```
-  ```cd .\DataVista```
-  ```cp .env.example .env```
-  ```docker-compose up --build```
-  ```docker-compose exec app composer install```
-  ```docker-compose exec app php artisan migrate```
-  ```docker-compose exec app php artisan db:seed --class=UsersTableSeeder```
-  ```docker-compose exec app php artisan db:seed --class=ClientsTableSeeder```

- Пароль для всех пользователей "1234"
