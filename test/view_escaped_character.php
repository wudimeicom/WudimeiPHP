<?php
//view_escaped_character
 
require_once __DIR__ .'/../autoload.php';
use Wudimei\View;

View::loadConfig( __DIR__ . '/view_config.php' );
//View::$forceCompile = false;
$vars = [
		'name' => 'Yang Qing-rong' 
];

echo View::make("default.index.view_escaped_character",$vars );