<?php
 
require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;


$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$select = DB::connection( );

$data = array(
	'title' => 'ha ha ',
	'content' => 'abc',
	'created_at' => date("Y-m-d H:i:s")
);

$lastInsertId = $select->table("blog")->insert( $data );
echo $lastInsertId;

 

 