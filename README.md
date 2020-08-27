# Регистрация, аутентификация и авторизация на Phalcon 4
## Развертывание
1. Установить phalcon 4, nginx, php7.4, php-fpm, mysql
1. Создать базу данных
1. Выполнить `$ cp .env.example .env`
1. Изменить настройки подключения к БД в `.env` (DB_SCHEMA - имя БД для mysql и имя схемы (default - public) для postgresql)
1. Выполнить `$ install.sh`
1. Создать виртуальный хост (virtual host) веб-сервера для папки `./public`
1. Можно открывать сайт в браузере