WudimeiPHP 
a php 7 development framework created by wudimei.com

more infomation please see the "test" folder
the "test" folder can be deleted for saving disk space.

installation:

1. please download wudimeiPHP https://github.com/wudimeicom/WudimeiPHP/archive/master.zip
2. unzip it and move to a directory you want
3. require the autoload.php
3. use namespance of the specified class you need
for example:

<?php
//test/hello.php
require_once __DIR__ .'/../autoload.php';
use Wudimei\Registry;
Registry::set("name","world");
echo "hello," . Registry::get("name") . "!";
?>

licence:

The MIT License (MIT)