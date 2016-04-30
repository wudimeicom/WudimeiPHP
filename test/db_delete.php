<?php
 

require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;


$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$select = DB::connection( );

 
$lastInsertId = $select->table("blog")->where('id',12)->orWhere('id',11)->orWhere('id',10)->delete( );
echo $lastInsertId;



