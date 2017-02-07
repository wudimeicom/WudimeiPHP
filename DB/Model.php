<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\DB;
use DB;
use Wudimei\DB\Query\PDO_MYSQL;
use Event;

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
		$select = clone DB::connection($this->connection);
		//$select->setModel( $this);
		$select->table( $this->table );
		$this->select =  $select;
		$this->bindEvents();
	}
	public function __call($name,$args){
		return call_user_func_array([$this->select,$name], $args );
	}
	 
	public static function __callstatic($method,$args){
		$model = new static();
		if( $method == 'find'){
			return $model->_find( $args[0]);
		}
		else{
			return call_user_func_array([$model,$method], $args );
		}
	}
	
	
	
	public function _find( $id ){
		$data = $this->select->where($this->primaryKey, $id )->limit(1, 0)->get();
	
		return @$data[0];
	}
	
	public function bindEvents(){
	    $tableName = $this->select->getTableName() ;
	    Event::listen( $tableName  . ".beforeChange", [$this,'beforeChange'] );
	    Event::listen( $tableName  . ".beforeUpdate", [$this,'beforeUpdate'] );
	    Event::listen( $tableName  . ".afterUpdate", [$this,'afterUpdate'] );
	    Event::listen( $tableName  . ".beforeInsert", [$this,'beforeInsert'] );
	    Event::listen( $tableName  . ".afterInsert", [$this,'afterInsert'] );
	    Event::listen( $tableName  . ".beforeDelete", [$this,'beforeDelete'] );
	    Event::listen( $tableName  . ".afterDelete", [$this,'afterDelete'] );
	    Event::listen( $tableName  . ".afterChange", [$this,'afterChange'] );
	}
	/**
	 *
	 * @param unknown $db
	 * @param unknown $data
	 */
	public function beforeChange( $db , $args){
	    //print_r( $args );
	}
	/**
	 *
	 * @param \Wudimei\DB\Query\PDO_MYSQL $db
	 * @param array $data
	 * @param int $affectedRows
	 */
	public function afterChange( $db , $args){
	   // print_r( $args );
	}
	
	/**
	 * 
	 * @param unknown $db
	 * @param unknown $data
	 */
	public function beforeUpdate( $db , $data){
	}
	/**
	 * 
	 * @param \Wudimei\DB\Query\PDO_MYSQL $db
	 * @param array $data
	 * @param int $affectedRows
	 */
	public function afterUpdate( $db , $data,$affectedRows){
	}
	/**
	 *
	 * @param unknown $db
	 * @param unknown $data
	 */
	public function beforeInsert( $db , $data){
	}
	/**
	 *
	 * @param \Wudimei\DB\Query\PDO_MYSQL $db
	 * @param array $data
	 * @param int $affectedRows
	 */
	public function afterInsert( $db , $data,$lastInsertId){
	    
	}
	
	/**
	 *
	 * @param unknown $db
	 * @param unknown $data
	 */
	public function beforeDelete( $db  ){
	   
	}
	/**
	 *
	 * @param \Wudimei\DB\Query\PDO_MYSQL $db
	 * @param array $data
	 * @param int $affectedRows
	 */
	public function afterDelete( $db , $affectedRows ){
	    
	}
}