<?php
require_once __DIR__ .'/../autoload2.php';
 //use Wudimei\StaticProxies\DB;
 

$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$select = DB::connection( );


$data = $select->table("blog")->where('id','>',0)
->groupBy("title")->having("id", 1)->having("id", 1)
 ->get();

//$data = $select->table("blog")->get();
echo "<pre>";
print_r( $data );
echo "</pre>";

