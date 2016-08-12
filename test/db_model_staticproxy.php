<?php


require_once __DIR__ .'/../autoload2.php';
 
//use Wudimei\StaticProxies\DB;
use Wudimei\DB\Model;

DB::loadConfig(__DIR__ . "/db_config.php" );

class BlogModel extends Model{
	public $table = "blog";
	//public $primaryKey = "id";
	
}




$data = BlogModel::where("id",'>',0)->get();


//$data = BlogModel::where("id",'>',0)->toSql();
print_r( $data );

