<?php
/**
 * my god
 * Deprecated: Non-static method Wudimei\DB\Model::where() should not be called statically in D:\www\wudimei\library\Wudimei\test\db_model_defaultInstance.php on line 19

Fatal error: Uncaught Error: Using $this when not in object context in D:\www\wudimei\library\Wudimei\DB\Model.php:52 Stack trace: #0 D:\www\wudimei\library\Wudimei\test\db_model_defaultInstance.php(19): Wudimei\DB\Model::where('id', '>', 0) #1 {main} thrown in D:\www\wudimei\library\Wudimei\DB\Model.php on line 52
 */
require_once __DIR__ .'/../autoload.php';
use Wudimei\DB;
use Wudimei\DB\Model;
use Wudimei\DefaultInstance;
//use Wudimei\DB\Query\PDO_Abstract;

class BlogModel extends Model{
	public $table = "blog";
	//public $primaryKey = "id";
	
}

$config = include __DIR__ . "/db_config.php";
DB::addConnection($config);


$data = BlogModel::where("id",'>',0)->get();

print_r( $data );

