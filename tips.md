# Заметки для разработчиков

### Приложение

#### Установка

* Открываем консоль, переходим в папку со всеми доменами. OpenServer: `cd domains`

* `git clone https://github.com/roman-deniskin/find-out.dev.git find-out.dev`

* `cd find-out.dev`

* `composer install`

* `php artisan vendor:publish`

* `php artisan key:generate`

#### Настройка

* Указать в настройках сервера директорию проекта public

* Скопировать файл .env.example в корневую директорию и переименовать в .env

* В файле .env прописать данные для соединения с базой данных

### Модули

#### Создание

-Будет сгенерирован модуль Blog:

`php artisan module:make Blog`

-Будут сгенерированы 3 модуля с соответствующими названиями:

`php artisan module:make Blog Portfolio User`

#### Публикация
В composer.json должны быть строки:

```
	"psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules"
        }
```

Если их нет - следует обновиться до последней версии репозитория так как автозагрузка модулей не будет работать.

После создания модуля его нужно опубликовать командой:

`composer dump-autoload`

#### Миграции в модулях

`php artisan module:make-migration <MigrationName> <ModuleName>`

Например:

`php artisan module:make-migration create_table_users user`

---------------------------------------

Полная документация по модулях есть на [оффициальном сайте пакета](http://sky.pingpong-labs.com/docs/2.0/modules)

### Работа с изображениями

Мы используем [ImageManager](https://github.com/anakadote/ImageManager-for-Laravel-5)
