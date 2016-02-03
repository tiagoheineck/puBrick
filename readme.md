## puBrick

### O que você precisa ter?

- PHP 5.5+
- Composer
- https://laravel.com/docs/5.2
- https://laravelcollective.com/



### Clonando

1. Clone o projeto
2. Rode o comando "composer install" na pasta do projeto


### Rodando

Configure seu arquivo .env com o banco de dados e as credenciais do facebook

APP_ENV=local
APP_DEBUG=true
APP_KEY=XXXXXXXXXX

DB_HOST=XXXXXXXXXX
DB_DATABASE=XXXXXXXXXX
DB_USERNAME=XXXXXXXXXX
DB_PASSWORD=XXXXXXXXXX

FACEBOOK_ID=XXXXXXXXXX
FACEBOOK_SECRET=XXXXXXXXXX

GOOGLE_MAPS_KEY=XXXXXXXXXX

1. Crie um banco de dados com o nome pubrick

2. php artisan migrate

3. php artisan serve