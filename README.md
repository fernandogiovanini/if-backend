Backend para o Índice Foda-se
=============================

[![Build Status](https://travis-ci.org/fernandogiovanini/if-backend.svg?branch=master)](https://travis-ci.org/fernandogiovanini/if-backend)

##Para iniciar o ambiente de desenvovimento

```
git clone git@github.com:fernandogiovanini/if-backend.git 
cd if-backend/ 
docker-compose up -d 
```

+ Nginx em [http://localhost:80](http://localhost:80)

+ PostgreSQL em [http://localhost:5432](http://localhost:5432)

+ Console do Beanstalkd em [http://localhost:2080](http://localhost:2080)

Mais informações dos serviços no arquivo [docker-compose.yml](./docker-compose.yml)


##Para instalar o projeto

 ```
cd if-backend
docker-compose run phpfpm-no-xdebug composer install
```

##Para executar o composer

 ```
cd if-backend
docker-compose run phpfpm-no-xdebug composer <parametros>
```

##Para executar o PHPUnit

 ```
cd if-backend
docker-compose run phpfpm phpunit <parametros>
```

##Para executar o php-cs-fixer

 ```
cd if-backend
docker-compose run phpfpm-no-xdebug php-cs-fixer <parametros>
```