# Trip Builder Project

A simple webservice PHP made with Laravel

## Prerequisites

**Install docker and docker-compose**

https://docs.docker.com/compose/install/

**Clone this repository**

```
git clone https://github.com/guillaumejust/trip-builder-docker.git
```

## Installation

Go to the project directory.

Exec this command to start the containers.

```
docker-compose up -d
```

Exec this command after container start-up 

```
docker-compose exec app composer init-project
```

Change Database connexion into .env and .env-testing

**.env**
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=trip_builder
DB_USERNAME=root
DB_PASSWORD=123456
```

**.env-testing**
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=trip_builder_testing
DB_USERNAME=root
DB_PASSWORD=123456
```

You can access the local web api via: http://127.0.0.1/api/v1/

## Database Docker

Connect your DB with your favorite client

```
HOST: 127.0.0.1
PORT: 3306
DB: trip_builder
USER: root
Password: 123456
```

If you want to go inside database docker

```
docker-compose exec db bash
```

## Testing 

Before runnig unit test you must create a database ```trip_builder_testiong```

To running Unit test
```
docker-compose exec app composer test
```

## API 

I used postman to call my web service https://www.getpostman.com

You can import my collections and my environment, go to folder postman


