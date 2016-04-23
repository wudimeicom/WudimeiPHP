<?php

namespace Wudimei\DB\Query;

use Wudimei\DB\Query\Pagination\Paginator;

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
		$this->sqlArray["limit"] = [];
		$this->sqlArray["orderBy"] = [];
	}
	public function select($select="*"){
		$this->sqlArray["select"] = $select;
		return $this;
	}
	
	public function table($tableName){
		$this->sqlArray["table"] = $tableName;
		return $this;
	}
	public function limit($limit,$offset){
		$this->sqlArray["limit"] = [$limit,$offset];
		return $this;
	}
	
	public function orderBy($field,$direction="asc"){
		$this->sqlArray["orderBy"][$field] = $direction;
		return $this;
	}
	
	public function where($field,$param2,$param3 = null , $boolean = 'and'){
		if( $param3 === null ){
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
			$item = @$where[$i];
			$type = @$item[0];
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
		
		$orderBy = $this->getSqlArrayItem("orderBy",[]);
		if( !empty( $orderBy) ){
			$orderArr = [];
			foreach ( $orderBy as $field => $direction ){
				$orderArr[] = $field . " " . $direction;
			}
			$sql .= " order by ". implode(",", $orderArr);
		}
		
		
		
		
		$limit = $this->getSqlArrayItem("limit",[]);
		if( !empty( $limit)){
			$l = $limit[0];
			$offset = $limit[1];
			$sql .= " limit " . $l . " offset " . $offset;
		}
		
		$data = $this->executeQuery( $sql , $this->sqlArray["bindings"] );
		$this->clearSqlArray();
		return $data;
		
	}
	/**
	 * 
	 * @param number $perPage
	 * @param null|int $page
	 */
	public function paginate($perPage = 15, $page = null)
	{
		$othis = clone $this;
		$total = $othis->count();
		// echo $total;
		$pageCount = ceil( $total / $perPage );
		if( $page == null ){
			$page = intval( @$_GET["page"] );
		}
		if( $page == 0 ){
			$page = 1;
		}
		if( $page> $pageCount ){
			$page = $pageCount;
		}
		$offset = ($page-1)*$perPage;
		//echo "[" .$page . " , ".  $pageCount . " , ". $offset. "]";
		
		$data = $this->limit( $perPage, $offset )->get();
		//print_r( $data );
		
		$paginator = new Paginator();
		$paginator->first =1;
		$paginator->last = $pageCount;
		$paginator->page = $page;
		$paginator->size = $perPage;
		$paginator->total = $total;
		$paginator->data = $data;
		return $paginator;
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