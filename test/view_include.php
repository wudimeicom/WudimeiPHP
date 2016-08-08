<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\StaticProxies\View;

View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
		 
		'username' => 'Yang Qing-rong'
		
];

echo View::make("default.index.include",$vars );