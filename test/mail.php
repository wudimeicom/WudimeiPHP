<?php
require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");

Mail::loadConfig(__DIR__ . "/mail_config.php");

 Mail::to('yaqy@qq.com,admin <admin@wudimei.com>')->cc("yangqingrong@wudimei.com")
 ->subject("abc22222杨庆荣222")->content("efg2杨庆荣，杨庆荣，杨庆荣")->send();
 


echo 123;
