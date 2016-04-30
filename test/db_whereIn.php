<?php
 
require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;


$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$select = DB::connection( );


$data = $select->table("blog")->whereIn('id',[1,2,3] )->orWhereIn('id',[6,7] )->get();

echo "<pre>";
print_r( $data );
echo "</pre>";

 