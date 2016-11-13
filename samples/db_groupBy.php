<?php
require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");
 

DB::loadConfig(__DIR__ . "/db_config.php" );


$select = DB::connection( );


$data = $select->table("blog")->where('id','>',0)
->groupBy("title")->having("id", 1)->having("id", 1)
 ->get();

//$data = $select->table("blog")->get();
echo "<pre>";
print_r( $data );
echo "</pre>";

