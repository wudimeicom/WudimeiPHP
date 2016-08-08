<?php


require_once __DIR__ .'/../autoload2.php';
 
//use Wudimei\StaticProxies\DB;
use Wudimei\DB\Model;


class BlogModel extends Model{
	public $table = "blog";
	//public $primaryKey = "id";
	
}

$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$data = BlogModel::where("id",'>',0)->get();


//$data = BlogModel::where("id",'>',0)->toSql();
print_r( $data );

