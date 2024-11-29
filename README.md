atlas_overview_2024

Clone Repositório:
```
Visão geral:
git clone git@github.com:raphaelgmoraes/atlas_overview_2024.git

Aplicação - Catálogo de video: Pasta: microservice-catalog-video

```
Implementar uma aplicação básica que para criar uma categoria de vídeos.

TDD, Laravel(Camada de Infraestrutura), Mensageria(RabbitMQ e Kafka) e Docker


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
Acessar a pasta: microservice-catalog-video e seguir com os passos.

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
```

2° Etapa: Mensageria

```
RabbitMQ - Conversões de video
A idéia é simular um processo de conversão de vídeos, reduzindo resursos do sistema.
Em andamento

Kafka - Replicador de Dados
Em andamento'

```
```
3° Observabilidade (ElasticSearch)
Em andamento
```
