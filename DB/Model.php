<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\DB;
use Wudimei\StaticProxies\DB;
use Wudimei\DB\Query\PDO_MYSQL;
use Wudimei\DefaultInstance;

class Model{
	public $table; //without prefix
	public $primaryKey = 'id';
	public $connection = 'default' ; //default connection
	/**
	 * 
	 * @var PDO_MYSQL
	 */
	public $select;
	
	
	
	public function __construct(){
		$select = DB::connection($this->connection);
		$select->table( $this->table );
		$this->select = $select;
		
	}
	public function __call($name,$args){
		return call_user_func_array([$this->select,$name], $args );
	}
	 
	public static function __callstatic($method,$args){
		$model = new static();
		return call_user_func_array([$model,$method], $args );
	}
	
	
	
	public function find( $id ){
		$data = $this->select->where($this->primaryKey, $id )->limit(1, 0)->get();
	
		return @$data[0];
	}
}