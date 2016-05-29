yii2 db schema 
===============
help you refresh db schema

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist gangbo/yii2-dbschema "*"
```

or add

```
"gangbo/yii2-dbschema": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
'modules' => [
    ...
    'dbschema' => [
        'class' => 'gangbo\dbschema\Module',
    ],
    ...
]
```
http://yourhost/index.php?r=dbschema
