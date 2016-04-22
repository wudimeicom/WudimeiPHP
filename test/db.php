<?php
ini_set("display_errors",1);
error_reporting(E_ALL|E_ERROR|E_COMPILE_ERROR|E_CORE_ERROR);

require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;
 


DB::addConnection([
    'driver'    => 'PDO_MYSQL', // 'PDO_MYSQL' 'Wudimei\\DB\\Query\\PDO_MYSQL' 'your\\driver\\className'
    'host'      => 'localhost',
    'database'  => 'wudimei_cms',
    'username'  => 'root',
    'password'  => '123456',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => 'w_',
] );


$select = DB::connection( );
//$select = $select->table("blog");
/*
$arr = $select->table("blog")->where('id','>',1)->where('id','<',10)->where('id',5)->get();
print_r( $arr );
*/
/*
$arr = $select->select('title,id')->table("blog")->where('id',3)->orWhere('id',2)->get();
print_r( $arr ); 

$value = $select->select('title,id')->table("blog")->where('id',3)->orWhere('id',2)->count();
print_r( $value ); echo "<br />";

$value = $select->select('title,id')->table("blog")->where('id',3)->orWhere('id',2)->max('id');
print_r( $value ); echo "<br />";

$value = $select->select('title,id')->table("blog")->where('id',3)->orWhere('id',2)->min('id');
print_r( $value ); echo "<br />";

$value = $select->select('title,id')->table("blog")->where('id',3)->orWhere('id',2)->sum('id');
print_r( $value ); echo "<br />";
$value = $select->select('title,id')->table("blog")->where('id',3)->orWhere('id',2)->avg('id');
print_r( $value ); echo "<br />";

$value = $select->select('title,id')->table("blog")->where('title','like','test2%')->count('id');
print_r( $value ); echo "<br />";

$value = $select->select('title,id')->table("blog")->whereRaw('title like ?',['test%'])->count('id');
print_r( $value ); echo "<br />";

$value = $select->select('title,id')->table("blog")
->whereRaw('title like :kw or title like :kw2',['kw'=>'test2%','kw2'=>'test3%'])->count('id');
print_r( $value ); echo "<br />";
*/
$select = $select->select('title,id')->table("blog")
->whereRaw('title like :kw and  id>:minId',['kw'=>'test2%','minId'=>0])
->orWhereRaw(' title like :kw2',[ 'kw2'=>'test3%']);

$select2 = clone $select;
$value = $select2->count('id');
print_r( $value ); 
$data = $select->get();
print_r( $data );
echo "<br />";

//print_r( $select->sqlArray );
