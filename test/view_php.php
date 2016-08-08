<?php

require_once __DIR__ .'/../autoload.php';
use Wudimei\StaticProxies\View;

View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
		'index' => 0
];
 
echo View::make("default.index.php",$vars );