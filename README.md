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
CREATE USER map_user WITH ENCRYOTED PASSWORD 'pass';
GRANT ALL PRIVILEGES ON DATABESE map_db TO map_user;
# даем привелегию пользователю заводить базы (может пригодиться для тестов)
ALTER USER map_user CREATEDB;
# региональные настройки
ALTER ROLE map_user SET client_encoding TO 'utf8';
ALTER ROLE map_user SET timezone TO 'Europe/Moscow';
```

### Symfony

```bash
composer install --no-dev --optimize-autoloader
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
yarn encore production
APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear
```