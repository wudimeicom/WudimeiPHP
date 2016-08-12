<?php
 
require_once __DIR__ .'/../autoload2.php';
//use Wudimei\StaticProxies\DB;


DB::loadConfig(__DIR__ . "/db_config.php" );


$select = DB::connection( );

$data = array(
	'title' => 'ha ha 2',
	'content' => 'abc2',
	'created_at' => date("Y-m-d H:i:s")
);

$intAffectedRows = $select->table("blog")->where('id',1 )->update( $data );
echo $intAffectedRows;

 

 