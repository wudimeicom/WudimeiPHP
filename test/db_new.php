<?php

use Wudimei\DB;

require_once __DIR__ .'/../autoload2.php';



$db = new DB();

$config = include __DIR__ . "/db_config.php";
$db->addConnection($config);


$select = $db->connection(  );

//$select = $db;


$data = $select->table("blog")->whereIn('id',[1,2,3] )->orWhereIn('id',[6,7] )->get();

echo "<pre>";
print_r( $data );
echo "</pre>";