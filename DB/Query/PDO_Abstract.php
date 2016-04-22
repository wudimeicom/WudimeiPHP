<?php

namespace Wudimei\DB\Query;
class PDO_Abstract{
	public $config;
	public $sqlArray;
	public $pdo;
	
	public function __construct($config){
		$this->config = $config;
		
		$this->clearSqlArray();
	}
	
	public function clearSqlArray(){
		$this->sqlArray["where"] = [];
		$this->sqlArray["bindings"] = [ ];
	}
	public function select($select="*"){
		$this->sqlArray["select"] = $select;
		return $this;
	}
	
	public function table($tableName){
		$this->sqlArray["table"] = $tableName;
		return $this;
	}
	
	public function where($field,$param2,$param3 = null , $boolean = 'and'){
		if( $param3 == null ){
			$param3 = $param2;
			$param2 = "=";
		}
		$this->sqlArray["where"][] = ['where',$field,$param2,$param3,$boolean];
		return $this;
	}
	public function orWhere($field,$param2,$param3 = null  ){
		return $this->where($field,$param2,$param3  , 'or');
	}
	
	public function whereRaw($sql, array $bindings = array(), $boolean = 'and')
	{
		$this->sqlArray["where"][] = ['whereRaw',$sql,$bindings,$boolean];
		return $this;
	}
	
	public function orWhereRaw($sql, array $bindings = array() )
	{
		$this->whereRaw($sql,  $bindings  , $boolean = 'or');
		return $this;
	}
	
	public function getSqlArrayItem( $name , $default = null){
		$item = @$this->sqlArray[$name];
		if( $item == null ){
			return $default;
		}
		return $item;
	}
	
	
	public function buildWhere(){
		$where = $this->getSqlArrayItem('where','' );
		 //print_r($where);
		$sql = " where 1 ";
		for( $i=0; $i< count( $where); $i++ ){
			$item = $where[$i];
			$type = $item[0];
			if( $type == "where" ){
				$field = $item[1];
				$p1 = $item[2];
				$p2 = $item[3];
				$boolean = $item[4];
				$sql .= " " . $boolean . " " . $field . " " . $p1 . " ? ";// . $p2;
				$this->sqlArray["bindings"][] = $p2;
			}
			elseif( $type == "whereRaw" ){
				$sqlParam = $item[1];
				$bindings = $item[2];
				$boolean = $item[3];
				$sql .= " " . $boolean . " " . $sqlParam ;
				if( !empty( $bindings)){
					foreach ( $bindings as $k => $v ){
						if( is_numeric( $k ) ){
							$this->sqlArray["bindings"][] = $v;
						}
						else{
							$this->sqlArray["bindings"][$k] = $v;
						}
						
					}
				}
			}
		}
		return $sql;
	}
	
	public function get(){
		$select =$this->getSqlArrayItem("select","*");
		
		$sql = "select " . $select;
		$table = $this->getSqlArrayItem("table","");
		$sql .= " from " . $this->config['prefix'].$table;
		$sql .= $this->buildWhere();
		$data = $this->executeQuery( $sql , $this->sqlArray["bindings"] );
		$this->clearSqlArray();
		return $data;
		
	}
	
	public function count($field = "*"){
		return $this->_function("count",$field );
	}
	
	public function max($field = "*"){
		return $this->_function("max",$field );
	}
	
	public function min($field = "*"){
		return $this->_function("min",$field );
	}
	
	public function sum($field = "*"){
		return $this->_function("sum",$field );
	}
	
	public function avg($field = "*"){
		return $this->_function("avg",$field );
	}
	
	public function _function($function,$field = "*"){
		$this->select( $function.'(' . $field . ') as cnt' );
		$data = $this->get();
		$cnt = $data[0]['cnt'];
		return $cnt;
	}
	
	public function getPDO(){
		if( $this->pdo != null ){
			return $this->pdo;
		}
		else{
			$dsn = '';
			$driver = $this->config['driver'];
			if( $driver == "PDO_MYSQL"){
				$dsn = "mysql:host=".$this->config['host'].";dbname=".$this->config['database'];
			}
			else{
				$dsn = $this->getDSN();
			}
			return $this->pdo = new \PDO($dsn, $this->config['username'], $this->config['password'] );
		}
	}
	
	public function getDSN(){
		return "";
	}
	/*
	public function execute( $sql ,$params = null){
		$pdo = $this->getPDO();
		echo $sql;
		$sth = $pdo->prepare( $sql );
		$ret = $sth->execute( $params );
		print_r( $pdo->errorInfo() );
		return $ret;
	}
	*/
	public function executeQuery( $sql ,$params = null ){
		$pdo = $this->getPDO();
		
		$sth = $pdo->prepare( $sql );
		$ret = $sth->execute( $params );
		echo $sql; print_r( $params );
		print_r( $sth->errorInfo() );
		$data = $sth->fetchAll();
		return $data;
	}
}