Yii2-auto-catalog
==========
Каталог автомобилей (только бекенд).

В состав входит возможность управлять (CRUD):

* Категории
* Марки
* Модели

Установка
---------------------------------
Выполнить команду

```
php composer require pistol88/yii2-auto-catalog "*"
```

Или добавить в composer.json

```
"pistol88/yii2-auto-catalog": "*",
```

И выполнить

```
php composer update
```

Далее, мигрируем базу:

```
php yii migrate --migrationPath=vendor/pistol88/yii2-auto-catalog/migrations
```

Настройка
---------------------------------

В секцию modules конфига добавить:

```
    'modules' => [
        //..
        'autocatalog' => [
            'class' => 'pistol88\autocatalog\Module',
            'adminRoles' => ['administrator'],
        ],
        //..
    ]
```

Использование
---------------------------------
* ?r=autocatalog/category - категории
* ?r=autocatalog/mark - марки
* ?r=autocatalog/model - модели

Виджеты
---------------------------------
Виджеты в разработке.
