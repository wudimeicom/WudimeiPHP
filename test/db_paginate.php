<?php
require_once __DIR__ .'/../autoload2.php';
// use Wudimei\StaticProxies\DB;
//use DB;


DB::loadConfig(__DIR__ . "/db_config.php" );


$select = DB::connection( );


$pg = $select->table("blog")->where('id','>',1)->where('id','<',10)->paginate(2);

echo "<pre>";
print_r( $pg->data );
echo "</pre>";

echo $pg->render("db_paginate.php?page={page}");
