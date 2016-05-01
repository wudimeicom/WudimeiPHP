<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\Session;

Session::loadConfig( __DIR__ . '/session_config.php' );
Session::start();

$name = Session::get("name");

echo $name;
