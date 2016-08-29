<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\StaticProxies\Session;

Session::loadConfig( __DIR__ . '/session_config.php' );
Session::start();

$name = Session::get("name");

echo $name;

echo Session::get("age");
//Session::keep(['age']);
//Session::reflash();
