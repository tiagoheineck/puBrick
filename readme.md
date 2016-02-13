## puBrick

### O que você precisa ter?

- PHP 5.5+
- Composer
- https://laravel.com/docs/5.2
- https://laravelcollective.com/



### Clonando

1. Clone o projeto
2. Rode o comando "composer install" na pasta do projeto


### Criando o banco de dados

Acesse o mysql e Crie um banco de dados com o nome **pubrick**

### Rodando

Configure seu arquivo .env com as configuracoes do banco de dados e das credenciais do facebook
```
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
```

1. php artisan migrate

2. php artisan key:generate

3. php artisan serve


Pronto, abra o navegador e digite http://localhost:8000
