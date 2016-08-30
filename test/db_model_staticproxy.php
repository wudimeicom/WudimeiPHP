<?php

require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");

use Wudimei\DB\Model;

DB::loadConfig(__DIR__ . "/db_config.php" );

class BlogModel extends Model{
	public $table = "blog";
	//public $primaryKey = "id";
	
}




$data = BlogModel::where("id",'>',0)->get();


//$data = BlogModel::where("id",'>',0)->toSql();
print_r( $data );

