<?php
 
require_once __DIR__ .'/../autoload.php';
use Wudimei\StaticProxies\View;

View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
	'name' => "Yang Qing-rong"
];

function hello($name){
	return 'hello,' . $name . '!';
}

echo View::make("default.index.function",$vars );