<?php
 
require_once __DIR__ .'/../autoload2.php';
//use Wudimei\StaticProxies\DB;

DB::loadConfig(__DIR__ . "/db_config.php" );


$select = DB::connection( );


$data = $select->table("blog")->whereIn('id',[1,2,3] )->orWhereIn('id',[6,7] )->get();

echo "<pre>";
print_r( $data );
echo "</pre>";

 