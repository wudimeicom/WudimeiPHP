<?php
//view_section_recursion 
require_once __DIR__ .'/../autoload.php';
use Wudimei\View;

View::loadConfig( __DIR__ . '/view_config.php' );
View::$forceCompile = true;
$vars = [
   'name' => 'yqr'		,
   'age' => 32,
   'name2' => ['first_name' => 'yang'],
   'data' => [
   		['name' => 'php'],
   		['name' => 'javascript'],
   		['name' => 'jquery']
   		
   ]
];

//echo View::make("default.layout.main",$vars );

 
 echo View::make("default.index.section_recursion2",$vars );