<?php

use Wudimei\DB;

require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");

 

$db = new DB();

$db->loadConfig( __DIR__ . "/db_config.php");


$select = $db->connection(  );

//$select = $db;


$data = $select->table("blog")->whereIn('id',[1,2,3] )->orWhereIn('id',[6,7] )->get();

echo "<pre>";
print_r( $data );
echo "</pre>";