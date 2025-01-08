# NordicCar Assessment

## Run Project:

To run project on your local follow these steps:
    
-  install docker
-  run ``` git clone git@github.com:amir-astarabadi/NordicCar.git``` 
-  got to ` NordicCar ` directory
-  run ``` docker compose up -d ```
-  run ``` docker exec -it nordic_php sh ```
-  run ``` cp .env.example .env && php artisan key:generate``` (Just For First Time)
-  run ``` php artisan system:deploy ```  

It will bring up: mysql, nginx, reids and php container as app dependencies on specific ports which are configurable from docker-compose.yml file.
Then with `system:deploy` command database will be populate with fake data in `local environment`

## App Architect

 - Repository layer exists to handle db queries
 - Utilitie layer (service layer) exists for resusable actions
 - I covered main features in Features test

## Concurrency Solution

 - To solve race condition I used two slutions:
    - Use DB transactions to commit all order placement changes like: tproduct deduc stock, store order items
    - Lock each product for update when creating order items and deduc stock

## High-traffic Solution

 - I dockerized project for horizental scale

