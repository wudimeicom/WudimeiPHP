<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\StaticProxies\Session;

Session::loadConfig( __DIR__ . '/session_config.php' );
Session::start();

Session::set("name",'Yang Qing-rong');

Session::flash('age',31);