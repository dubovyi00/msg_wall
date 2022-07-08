# About

Веб-приложение имеет следующие возможности
* Просмотр списка сообщений
* Просмотр сообщения с комментариями (включая возможность добавлять комментарии)
* Добавление нового сообщения
* Редактирование существующего сообщения

# Требования

* PHP >= 7.4
* MySQL >= 8.0

# Развёртывание и запуск

* Восстановите базу данных из дампа
> sudo mysql -u root < DBBACKUP.sql

* Запустите debug-сервер, приложение будет доступно по указанному адресу
> php -S 127.0.0.1:8080