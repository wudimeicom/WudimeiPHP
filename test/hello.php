<?php

require_once __DIR__ .'/../autoload.php';
use Wudimei\Registry;

Registry::set("name","world");
echo "hello," . Registry::get("name") . "!";
