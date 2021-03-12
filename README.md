<strong>Демо версия</strong> [efko.kadastrcard.ru](http://efko.kadastrcard.ru)

```
для проверки работы

Руководитель
Логин:  admin
Пароль: 123456

Сотрудник
Логин:  user
Пароль: 123456

задание

Требуется выполнить задание на Yii2 и прислать нам ссылку на ваш репозиторий. 
Если Вы не знакомы с Yii2, то можете выполнить задачу на удобном для вас фреймворке. 
Требуется выполнить задание и прислать нам ссылку на ваш репозиторий. 
Либо, если вы желаете использовать другой фреймворк то можете написать на php с ипользованием MVC.

Задача:
Нужно сделать простую систему. 
Есть рядовой сотрудник, который может:
•	ввести начало и конец отпуска;
•	посмотреть какие даты отпусков у других сотрудников. 
•	скорректировать свои даты.
Есть Руководитель, который может:
•	так же посмотреть какие даты ввели сотрудники.
•	поставить признак, что данные по отпуску конкретного сотрудника зафиксированы.
После этого сотрудник не может скорректировать свои даты
Не обязательно (если желаете лучше продемонстрировать свои умения)
•	Дополнительный функционал для страницы списка отпусков
•	Оформление readme и других вспомогательный решений
```



<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
