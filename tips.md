## «аметки дл€ разработчиков

### ћодули

#### —оздание
`php artisan module:make Blog` -- будет создан модуль Blog
`php artisan module:make Blog Portfolio User` -- будут созданы 3 модул€ с соответствующими названи€ми

#### ѕубликаци€
¬ composer.json должны быть строки:

`
	"psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules"
        }
`
≈сли их нет - следует обновитьс€ до последней версии репозитори€ так как автозагрузка модулей не будет работать.

ѕосле создани€ модул€ его нужно опубликовать командой:
`composer dump-autoload`

#### ћиграции в модул€х

`php artisan module:make-migration <MigrationName> <ModuleName>`

Ќапример:

`php artisan module:make-migration create_table_users user`

>>>> —ледуем общеприн€тым нормам в ведении миграций, дл€ создани€ таблицы создаем миграцию create_table_<table> , дл€ обновлени€ update_table_<table>. ¬се остальные названи€ можно найти в гугле.
