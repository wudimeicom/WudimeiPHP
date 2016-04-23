<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;


$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$select = DB::connection( );


$data = $select->table("blog")->where('id','>',0)->orderBy("title","desc")->orderBy('id','desc')->get();

echo "<pre>";
print_r( $data );
echo "</pre>";