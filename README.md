<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## CRUD | LARAVEL

Este sistema refere-se a um CRUD Laravel de gerenciamento de alunos, professores, disciplinas e turmas.


## O que vem nele?

- Já vem com autenticação padrão de usuário já com algumas traduções.

- Um crud pronto de produtos para modelo.

## Contributing

Se quiser contribuir entre em contato que vamos melhorar esse starter

## GET STARTED | INICIANDO

Para certificar o funcionamento do projeto é necessária a criação de um servidor web.
Para criação de um servidor local, são indicados os programas Xampp, Wampp ou similares.

Após a clonagem do diretório:

Selecione o arquivo .env e altere as informações de acordo com seu banco de dados:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE= || Nome do banco de dados ||
    DB_USERNAME= || Usuário do Banco de Dados ||
    DB_PASSWORD= || Senha do Usuário do Banco de Dados ||
    
Execute em seu terminal o seguinte comando para geração de chave:

    "php artisan key:gengerate"
    
Para instalação dos componentes do laravel execute o comando em seu terminal:

    "composer install"
    
No terminal entre na pasta da sua aplicação execute o comando:

    "php artisan migrate"

A partir de então o sistema estará pronto para ser utilizado.
Para efetuar login utilize as seguintes credenciais:
    Usuário: admin
    Senha: 123456
