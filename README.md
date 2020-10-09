#grpc-wksh-php

This repository has a main goal connected to grpc services 

## Running examples

```
# Start GRPC Flight Operator service
docker run -it --rm -p 8080:8080 gfelixc/grpc-wksp:latest

# Run dockerized environment included in this repo (see Dockerfile)
docker run --rm -it -v `pwd`:/app -w /app gfelixc/grpc-wksh-php:latest bash

# Install dependencies
composer install

# Define FLIGHT_OPERATOR_URL environment variable
export FLIGHT_OPERATOR_URL=docker.for.mac.localhost:8080

# Run examples
php run examples/flight_details.php
php run examples/departures.php
php run examples/travel_updates.php
php run examples/support_chat.php
```

## Generating PHP code from proto file
PHP code is generated by proto compiler using a proto file.

File `flight_operator.proto` contains definition of FlightOperator service.
In order to generate code from a proto file, first step is make sure this file has defined `option php_namespace`.

```
option php_namespace="FlightOperator";
```

There are many docker images across internet with the proto compiler ready to be used.  
In case of you want to build your own, you can find out how to do it in [official documentation](https://github.com/protocolbuffers/protobuf#protocol-compiler-installation)  
We are going to use [this image](https://github.com/namely/docker-protoc).

```
docker run -v `pwd`:/defs namely/protoc-all -f flight_operator.proto -l php -o FlightSDK
```

## Prepare your environment

In order to use generated code, we need to make sure to have:
- php 7.4
- composer
- grpc extension

### Local environment

```
# Install grpc extension
sudo pecl install grpc
```

Add in your `php.ini` following line:
```
extension=grpc.so
```

### Dockerized environment

`Dockerfile` in this repository provides you a docker image definition with tools needed.
You can build yourself of use published image in `gfelixc/grpc-wksh-php:latest`

```
docker run --rm -it -v `pwd`:/app -w /app gfelixc/grpc-wksh-php:latest bash
```

## Install dependencies

Make sure to have a composer.json with needed GRPC dependencies
```
"require": {
        "google/protobuf": "v3.13.0.1",
        "ext-grpc": "^1.32",
        "grpc/grpc": "^1.30"
    }
```

## Running examples

```
composer install
export FLIGHT_OPERATOR_URL=docker.for.mac.localhost:8080
php run examples/departures.php
```