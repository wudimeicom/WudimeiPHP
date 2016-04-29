<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\View;

View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
	'students' => [
   		['name' => 'jim','age'=>14  ],
   		['name' => 'lily','age'=>15 ],
   		['name' => 'lucy','age'=>13 ]
   ]
];

echo View::make("default.index.for",$vars );