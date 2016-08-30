<?php
 
require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");


DB::loadConfig(__DIR__ . "/db_config.php" );


$select = DB::connection( );

$data = array(
	'title' => 'ha ha 2',
	'content' => 'abc2',
	'created_at' => date("Y-m-d H:i:s")
);

/*
$data = new stdClass();
$data->title = "hello";
*/

$intAffectedRows = $select->table("blog")->where('id',1 )->update( $data );
echo $intAffectedRows;

 

 