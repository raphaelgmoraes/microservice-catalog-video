Atlas Tecnologies 2024

Microservice de Catalogo de videos - básico para apresentação

O Objetivo foi pegar as partes descritas na vaga para exemplificar um caso de uso simples, podendo abordar vários cenários.

Com TDD e Laravel(Camada de Infraestrutura)
Mensageria: 
    - RabbitMQ Simulando envio e recebimento de mensagem de uma categoria criada

Docker para containerização das aplicações no desenvolvimento

Clone Repositório:
```
Visão geral:
git clone git@github.com:raphaelgmoraes/atlas_overview_2024.git

Aplicação - Catálogo de video: Pasta: microservice-catalog-video
```
Docker version 27.3.1, build ce12230
```
```
Docker Compose version v2.29.7
```
```
Dockerfile >> Container PHP + nginx: serversideup/php:8.3-fpm-nginx
Link: https://hub.docker.com/r/serversideup/php/tags?name=8.4-fpm&page=1&ordering=-name
```
```
PHP Version: 8.3.14
```

```
PHP unit - v:11.4
Link: https://docs.phpunit.de/en/11.4/
```

```
Reference Mockery:
https://docs.mockery.io/en/latest/getting_started/installation.html
```

Subir a aplicação:

```
docker compose up -d

    * Sugestão: acessar sem o **-d** para acompanhar os logs dos containers e sua progressão.

Criar testes unidades:
    - docker compose exec app php artisan make:test caminho\\nomeDoTesteUnitTest
 
 
Radar os testes:
    -  docker compose exec app ./vendor/bin/phpunit (Forma Tradicional PHP Puro) 
    - docker compose exec app php artisan test (Via container docker)


Test INFO:
----------------------------------------------------------
docker compose exec app ./vendor/bin/phpunit 
PHPUnit 11.4.4 by Sebastian Bergmann and contributors.
Runtime:       PHP 8.3.14
Configuration: /var/www/html/phpunit.xml
.........................   25 / 25 (100%)
Time: 00:00.107, Memory: 36.50 MB
OK (25 tests, 44 assertions)
----------------------------------------------------------

Migration:
    - docker compose exec app migrate (Subir as migrações novas modificadas)
    - docker compose exec app migrate:rollback (reverter as alterações de migrações feitas - Sensível em produção)

Logs:
    - docker compose logs -f (Visualização dos logs em tempo de execução dos containers)
```
```

Cobertura de tests:
    1° Unit
    2° Integration (Classes)
    3° E2E (Comportament Fim a Fim)

Visão geral:

Sistema básico com Laravel e TDD
    - Application
        Use Cases:
            °Create   
            ° List   
            ° Delete   
            ° Get   
            ° Update   
        Agregates:
            °Category;
Entidade(Domain)
    Category
    
    
Rotas:

----------------------------------------
[All list]
GET > http://localhost/api/categories

[ById]
GET > http://localhost/api/categories/72f2d33c-be02-481a-b3a2-7052d39c444e
----------------------------------------
POST < http://localhost/api/categories
BODY {"name": "new_category_1"}

RESPONSE:
{
    "data": {
        "id": "7926c8e6-c8a5-4ec4-97b7-39a0d970f8e3",
        "name": "new_category_1",
        "description": "",
        "is_active": false,
        "created_at": "2024-11-28 23:40:16"
    }
}
----------------------------------------
PUT|PATCH 
----------------------------------------

```

2° Etapa: Mensageria

```

RabbitMQ

A idéia é simular um processo de conversão de vídeos, reduzindo resursos do sistema.
Informar que a categoria foi criada e tormar ações sobre.

Outros exemplos possíveis: 
 - Encoder videos
 - Processamento reviews
 - Informações de asssinaturas, notas fiscais, notificações usuários, etc ...

Comandos - Criado um command para simulação da categoria criada 

Porducer: docker compose exec app php artisan app:rabbitmq-producer
Consumer: docker compose exec app php artisan app:rabbitmq-consumer

Reference:
https://github.com/php-amqplib/php-amqplib
https://www.rabbitmq.com/tutorials/tutorial-one-php
Simulator: https://tryrabbitmq.com/


Payload- categoria criada:
{"app":"rabbitmq","info":"CategoryCreatedEvent","data":{"id":"f8a97443-9aaa-4449-89c2-fd2cae4d091e","name":"category_ut","description":"Quos libero velit voluptatibus atque quo consequatur harum quia ut eveniet.","active":true,"updated_at":"2024-11-29T14:02:44.000000Z","created_at":"2024-11-29T14:02:44.000000Z"}}
