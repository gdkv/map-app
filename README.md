## Symfony Map Application

### Requirements

* PHP >= 7.4 (Ctype, iconv, JSON, PCRE, Session, SimpleXML, Tokenizer, php-pgsql)
* PostgreSQL >= 12
* Symfony >= 5
* Composer
* yarn (или npm)

```bash
symfony check:requirements
```

### DB 

```bash
# cоздаем базу
CREATE DATABASE map_db;
# создаем пользователя и пароль
CREATE USER map_user WITH ENCRYPTED PASSWORD 'pass';
GRANT ALL PRIVILEGES ON DATABASE map_db TO map_user;
# даем привелегию пользователю заводить базы (может пригодиться для тестов)
ALTER USER map_user CREATEDB;
# региональные настройки
ALTER ROLE map_user SET client_encoding TO 'utf8';
ALTER ROLE map_user SET timezone TO 'Europe/Moscow';
```

### Symfony

#### dev

```bash
composer install
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
yarn install
yarn encore dev --watch
symfony console cache:clear
```

#### production

заводим .env.local:

```txt
APP_ENV=prod
APP_DEBUG=0
DATABASE_URL=pgsql://user:pass@127.0.0.1:5432/db
```

```bash
composer install --no-dev --optimize-autoloader
php bin/console doctrine:migration:migrate
yarn install
yarn encore production
php bin/console cache:clear   
```