### WudimeiPHP
a php 7 development framework created by wudimei.com

more infomation please see the "test" folder
the "test" folder can be deleted for saving disk space.
## Try WudimeiMVC
WudimeiMVC is a ready-to-use project that wrote by the same author,it's base on WudimeiPHP, url https://github.com/wudimeicom/WudimeiMVC

Note: the `test` folder is deprecated ,please view the new things from WudimeiMVC

## Installation:

1. use composer
```bash
composer require wudimeicom/wudimeiphp:dev-main
```
3. require the autoload.php
3. use namespance of the specified class you need
for example:

```php
<?php
//db_config.php
return [
    'driver'    => 'PDO_MYSQL', // 'PDO_MYSQL' 'Wudimei\\DB\\Query\\PDO_MYSQL' 'your\\driver\\className'
    'host'      => 'localhost',
    'database'  => 'wudimei_cms',
    'username'  => 'root',
    'password'  => '123456',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => 'w_',
] ;

<?php
// test.php
require_once __DIR__ .'/vendor/autoload.php';

DB::loadConfig(__DIR__ . "/db_config.php" );

$select = DB::connection( );

$pg = $select->table("blog")->where('id','>',1)->where('id','<',10)->paginate(2);

echo "<pre>";
print_r( $pg->data );
echo "</pre>";

echo $pg->render("db_paginate.php?page={page}");
?>
```

## Documentation
http://php.wudimei.com/doc/cn/201609/index.md.html

## WudimeiMVC

a demo project that use WudimeiPHP Framework

https://github.com/wudimeicom/WudimeiMVC

## DE Content Assist for WudimeiPHP
https://github.com/yangqingrong/WudimeiPHP_IDE_Content_Assist


## Licence:

The MIT License (MIT)


