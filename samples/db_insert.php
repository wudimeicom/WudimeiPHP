<?php
 
require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");


DB::loadConfig(__DIR__ . "/db_config.php" );


$select = DB::connection( );

$data = array(
	'title' => 'ha ha ',
	'content' => 'abc',
	'created_at' => date("Y-m-d H:i:s")
);

$lastInsertId = $select->table("blog")->insert( $data );
echo $lastInsertId;

 

 