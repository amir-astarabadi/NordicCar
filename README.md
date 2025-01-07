# NordicCar Assessment

## Run Project:

To run project on your local follow these steps:
    
-  install docker
-  run ``` git clone git@github.com:amir-astarabadi/NordicCar.git``` 
-  got to ` NordicCar ` directory
-  run ``` docker compose up -d ```
-  run ``` docker exec -it nordic_php sh ```
-  run ``` php artisan system:deploy ```  

It will bring up: mysql, nginx, reids and php container as app dependencies on specific ports which are configurable from docker-compose.yml file.
Then with `system:deploy` command database will be populate with fake data in `local environment`

## App Architect

## Concurrency Solution

## High-traffic Solution

