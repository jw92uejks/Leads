# 📘 1.0 Instalação PHP + Extensões + Laravel + Breeze (Windows)

## 1.1 ✔️ Verificar a instalação do PHP

``` bash
php -v
```

Requisito: PHP **8.3+** (ideal 8.4).

------------------------------------------------------------------------

## 1.2. ✔️ Ativar extensões obrigatórias no `php.ini`

O arquivo `php.ini` fica na pasta onde você instalou o PHP.

Extensões recomendadas:

    bcmath
    calendar
    ctype
    curl
    dom
    exif
    fileinfo
    filter
    ftp
    gd
    iconv
    intl
    json
    mbstring
    mysqlnd
    openssl
    pdo_mysql
    SimpleXML
    sockets
    tokenizer
    xml
    xmlreader
    xmlwriter
    xsl
    zip
    zlib

------------------------------------------------------------------------

## 1.3. ✔️ Verificar extensões ativas

``` bash
php -m
```

------------------------------------------------------------------------

## 1.4. ✔️ Verificar qual php.ini está sendo usado

``` bash
php --ini
```

------------------------------------------------------------------------

## 1.5. ✔️ Criar o projeto Laravel

``` bash
cd C:\laragon\www
composer create-project laravel/laravel mercadodeleads
cd mercadodeleads
```

------------------------------------------------------------------------

## 1.6. ✔️ Gerar chave da aplicação

``` bash
php artisan key:generate
```

------------------------------------------------------------------------

## 1.7. ✔️ Configurar banco no .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mercado
    DB_USERNAME=root
    DB_PASSWORD=

------------------------------------------------------------------------

## 1.8. ✔️ Migrar e semear

``` bash
php artisan migrate:fresh --seed
```

------------------------------------------------------------------------

## 1.9. ✔️ Instalar Breeze (Blade)

``` bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

------------------------------------------------------------------------

## 1.10. ✔️ Rodar o servidor

``` bash
php artisan serve
```

Acesse: http://localhost:8000

------------------------------------------------------------------------

## 1.11. ⚠️ Erros Comuns

### "Could not open input file: artisan"

``` bash
cd C:\laragon\www\mercadodeleads
```

### Extensões faltando

Adicionar no php.ini:

    extension=mbstring
    extension=pdo_mysql
    extension=intl
    extension=curl
    extension=fileinfo
    extension=gd
    extension=zip
