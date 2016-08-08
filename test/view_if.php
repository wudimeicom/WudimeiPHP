<?php
require_once __DIR__ .'/../autoload.php';
//use Wudimei\View;
use Wudimei\StaticProxies\View;


View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
		'success' => true		,
		'role' => 'admin'
		
];

echo View::make("default.index.if",$vars );