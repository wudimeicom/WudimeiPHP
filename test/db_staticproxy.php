<?php
require_once __DIR__ .'/../autoload2.php';
//use Wudimei\StaticProxies\DB;


$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);

 

$data = DB::table("blog")->where('id','>',0)->orderBy("title","desc")->orderBy('id','desc')->get();

echo "<pre>";
print_r( $data );
echo "</pre>"; 