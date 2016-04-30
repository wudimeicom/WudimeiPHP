<?php
 
require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;


$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$select = DB::connection( );

$data = array(
	'title' => 'ha ha 2',
	'content' => 'abc2',
	'created_at' => date("Y-m-d H:i:s")
);

$lastInsertId = $select->table("blog")->where('id',1 )->update( $data );
echo $lastInsertId;

 

 