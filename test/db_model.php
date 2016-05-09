<?php

require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;
use Wudimei\DB\Model;
use Wudimei\DB\Query\PDO_Abstract;

class BlogModel extends Model{
	public $table = "blog";
	//public $primaryKey = "id";
}

$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);

//PDO_Abstract::$fetchStyle = \PDO::FETCH_NUM;
$blogModel = new BlogModel();
//$data = $blogModel->where('id', '>',0)->get(); print_r( $data );

// $blog = $blogModel->find(8); print_r( $blog );

//echo $blogModel->insert(['title'=>'wudimei.com','content'=>'wudimei wudimei','created_at'=>date('Y-m-d H:i:s')]);
/*
$newBlog = new \stdClass();
$newBlog->title = 'yang qing-rong';
$newBlog->content = 'yang';
$newBlog->created_at = date('Y-m-d H:i:s');
echo $blogModel->insert( $newBlog );
*/
/*
$blog = $blogModel->find(8); print_r( $blog );
$blog->title = "happy new year2";

echo $blogModel->where("id", 8)->update( $blog );
// echo $blogModel->where("id", 8)->update(['title'=>'abc333']);
$blog = $blogModel->find(8); print_r( $blog );
*/
/*

$newBlog = new \stdClass();
$newBlog->title = 'yang qing-rong';
$newBlog->content = 'yang';
$newBlog->created_at = date('Y-m-d H:i:s');
echo $blogModel->insert( $newBlog );

*/
/*

echo $blogModel->where('id',13)->delete();

*/