<?php
require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");

View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
		'success' => true		,
		'role' => 'admin'
		
];

echo View::make("default.index.end",$vars );