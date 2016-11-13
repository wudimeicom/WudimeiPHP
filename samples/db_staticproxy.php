<?php
require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");


DB::loadConfig(__DIR__ . "/db_config.php" );

 

$data = DB::table("blog")->where('id','>',0)->orderBy("title","desc")->orderBy('id','desc')->get();

echo "<pre>";
print_r( $data );
echo "</pre>"; 