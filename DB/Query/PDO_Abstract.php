<?php

namespace Wudimei\DB\Query;

use Wudimei\DB\Query\Pagination\Paginator;

class PDO_Abstract{
	public $config;
	public $sqlArray;
	public $pdo;
	public static $sqlHistory = [];
	public static $fetchStyle = \PDO::FETCH_OBJ;
	public function __construct($config){
		$this->config = $config;
		
		$this->clearSqlArray();
	}
	
	public function clearSqlArray(){
		$this->sqlArray["where"] = [];
		$this->sqlArray["bindings"] = [ ];
		$this->sqlArray["limit"] = [];
		$this->sqlArray["orderBy"] = [];
		$this->sqlArray["groupBy"] = "";
		$this->sqlArray["having"] = [];
	}
	public function select($select="*"){
		$this->sqlArray["select"] = $select;
		return $this;
	}
	
	public function from($tableName){
		$this->sqlArray["table"] = $tableName;
		return $this;
	}

	public function table($tableName){
		return $this->from($tableName);
	}
	public function limit($limit,$offset){
		$this->sqlArray["limit"] = [$limit,$offset];
		return $this;
	}
	
	public function orderBy($field,$direction="asc"){
		$this->sqlArray["orderBy"][$field] = $direction;
		return $this;
	}
	
	public function groupBy( $field ){
		$this->sqlArray["groupBy"] = $field ;
		return $this;
	}
	public function where($field,$param2,$param3 = null , $boolean = 'and'  ){
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
	public function whereIn($field, array $values = array(), $boolean = 'and')
	{
		$this->sqlArray["where"][] = ['whereIn',$field,$values,$boolean];
		return $this;
	}
	public function orWhereIn($field, array $values = array() )
	{
		return $this->whereIn($field,  $values , $boolean = 'or');
	}
	public function having($field,$param2,$param3 = null , $boolean = 'and'){
		if( $param3 === null ){
			$param3 = $param2;
			$param2 = "=";
		}
		$this->sqlArray["having"][] = ['having',$field,$param2,$param3,$boolean];
		return $this;
	}
	public function orHaving($field,$param2,$param3 = null  ){
		return $this->having($field,$param2,$param3  , 'or');
	}
	
	public function havingRaw($sql, array $bindings = array(), $boolean = 'and')
	{
		$this->sqlArray["having"][] = ['havingRaw',$sql,$bindings,$boolean];
		return $this;
	}
	
	public function orHavingRaw($sql, array $bindings = array() )
	{
		$this->havingRaw($sql,  $bindings  , $boolean = 'or');
		return $this;
	}
	
	
	public function getSqlArrayItem( $name , $default = null){
		$item = @$this->sqlArray[$name];
		if( $item == null ){
			return $default;
		}
		return $item;
	}
	/**
	 * $where = [
	 *   [ where , id , =, ?, and ]
	 *   [ whereIn , id, [1,2,3],and ]
	 * ]
	 */
	
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
			elseif( $type == 'whereIn'){
				$field = $item[1];
				$values = $item[2];
				$boolean = $item[3];
				$params = [];
				for( $j=0;$j< count( $values); $j++ ){
					$params[] = "?";
				}
				$sql .= " " . $boolean . " " . $field . " in(" . implode(',',$params) . " ) ";
				$this->sqlArray["bindings"] = array_merge( $this->sqlArray["bindings"] , $values );
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
	

	public function buildHaving(){
		$where = $this->getSqlArrayItem('having','' );
		//print_r($where);
		$sql = "  having 1 ";
		for( $i=0; $i< count( $where); $i++ ){
			$item = @$where[$i];
			$type = @$item[0];
			if( $type == "having" ){
				$field = $item[1];
				$p1 = $item[2];
				$p2 = $item[3];
				$boolean = $item[4];
				$sql .= " " . $boolean . " " . $field . " " . $p1 . " ? ";// . $p2;
				$this->sqlArray["bindings"][] = $p2;
			}
			elseif( $type == "havingRaw" ){
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
	
	public function toSql(){
		$select =$this->getSqlArrayItem("select","*");
		
		$sql = "select " . $select;
		$table = $this->getSqlArrayItem("table","");
		$sql .= " from " . $this->config['prefix'].$table;
		$sql .= $this->buildWhere();
		

		$groupBy =  $this->getSqlArrayItem("groupBy", "");
		if( $groupBy != "" ){
			$sql .= " group by " . $groupBy;
			$sql .= $this->buildHaving();
		}
		
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
		
		return $sql;
	}
	public function get(){
		$sql = $this->toSql();
		$data = $this->executeQuery( $sql , $this->sqlArray["bindings"] );
		$this->clearSqlArray();
		return $data;
		
	}
	public function all(){
		
		return $this->get();
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
		 //echo $sql; print_r( $params );
		//print_r( $sth->errorInfo() );
		self::$sqlHistory[] = [$sql,$params, $sth->errorInfo()];
		$data = $sth->fetchAll(static::$fetchStyle);
		return $data;
	}
	/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
	public function executeUpdate( $sql,$params = null ){
		$pdo = $this->getPDO();
		
		$sth = $pdo->prepare( $sql );
		$ret = $sth->execute( $params );
		//echo $sql; print_r( $params );
		//print_r( $sth->errorInfo() );
		self::$sqlHistory[] = [$sql,$params, $sth->errorInfo()];
		//$data = $sth->fetchAll();
		return $sth;
	}
	
	
	public function insert( $data ){
		//echo $this->toSql();
		$fields = [];
		$values = [];
		$params = [];
		if( !empty( $data )){
			foreach ( $data as $field => $value ){
				$fields[] = $field;
				$values[] = $value;
				$params[] = '?';
			}
		}
		$tableName =$this->config['prefix']. $this->sqlArray["table"] ;
		$sql = "insert into " . $tableName . " (" .implode(",", $fields) . ") values(" .implode(",", $params) . ") ";
		$ret = $this->executeUpdate($sql , $values);
		//echo $ret;
		$pdo = $this->getPDO();
		$this->clearSqlArray();
		return $pdo->lastInsertId();
		
	}
	public function update( $data ){
		//echo $this->toSql();
		 
		$setArr = array();
		$values = [];
		if( !empty( $data )){
			foreach ( $data as $field => $value ){
				$setArr[] = '' . $field . ' = ? ';
				$values[] = $value;
			}
		}
		$where = $this->buildWhere();
		$bindings = $this->sqlArray["bindings"];
		//print_r( $values ); print_r( $bindings);
		$values = array_merge( $values, $bindings );
		//print_r( $values );
		
		$tableName =$this->config['prefix']. $this->sqlArray["table"] ;
		$sql = "update " . $tableName . " set " .implode(',', $setArr) . $where  ;
		//echo $sql;
		
		$sth = $this->executeUpdate($sql , $values);
		$this->clearSqlArray();
		return $sth->rowCount();
		//return $ret;
		//$pdo = $this->getPDO();
		//return $pdo->
	
	}
	
	public function delete(  ){
		  
		$where = $this->buildWhere();
		$bindings = $this->sqlArray["bindings"];
		 
		$tableName =$this->config['prefix']. $this->sqlArray["table"] ;
		$sql = "delete from " . $tableName . "  "  . $where  ;
	
		$sth = $this->executeUpdate($sql ,$bindings);
		$this->clearSqlArray();
		return $sth->rowCount();
		//return $ret;
		//$pdo = $this->getPDO();
		//return $pdo->
	
	}
}