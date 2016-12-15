<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
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
		$this->sqlArray["select"] = "*";
		$this->sqlArray["where"] = [];
		$this->sqlArray["bindings"] = [ ];
		$this->sqlArray["limit"] = [];
		$this->sqlArray["orderBy"] = [];
		$this->sqlArray["groupBy"] = "";
		$this->sqlArray["having"] = [];
		$this->sqlArray['join'] = [];
	}
	/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function select($select="*"){
		$this->sqlArray["select"] = $select;
		return $this;
	}
	/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function from($tableName){
		$this->sqlArray["table"] = $tableName;
		return $this;
	}
	/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function table($tableName){
		return $this->from($tableName);
	}
	/**
	 * 
	 * @param int $limit
	 * @param int $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function limit($limit,$offset){
		$this->sqlArray["limit"] = [$limit,$offset];
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function orderBy($field,$direction="asc"){
		$this->sqlArray["orderBy"][$field] = $direction;
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function groupBy( $field ){
		$this->sqlArray["groupBy"] = $field ;
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function where($field,$param2,$param3 = null , $boolean = 'and'  ){
		if( $param3 === null ){
			$param3 = $param2;
			$param2 = "=";
		}
		$this->sqlArray["where"][] = ['where',$field,$param2,$param3,$boolean];
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function orWhere($field,$param2,$param3 = null  ){
		return $this->where($field,$param2,$param3  , 'or');
	}
	/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function whereRaw($sql, array $bindings = array(), $boolean = 'and')
	{
		$this->sqlArray["where"][] = ['whereRaw',$sql,$bindings,$boolean];
		return $this;
	}
	/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function orWhereRaw($sql, array $bindings = array() )
	{
		$this->whereRaw($sql,  $bindings  , $boolean = 'or');
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function whereIn($field, array $values = array(), $boolean = 'and')
	{
		$this->sqlArray["where"][] = ['whereIn',$field,$values,$boolean];
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function orWhereIn($field, array $values = array() )
	{
		return $this->whereIn($field,  $values , $boolean = 'or');
	}
	/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function having($field,$param2,$param3 = null , $boolean = 'and'){
		if( $param3 === null ){
			$param3 = $param2;
			$param2 = "=";
		}
		$this->sqlArray["having"][] = ['having',$field,$param2,$param3,$boolean];
		return $this;
	}
	/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function orHaving($field,$param2,$param3 = null  ){
		return $this->having($field,$param2,$param3  , 'or');
	}
	/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function havingRaw($sql, array $bindings = array(), $boolean = 'and')
	{
		$this->sqlArray["having"][] = ['havingRaw',$sql,$bindings,$boolean];
		return $this;
	}
	/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
	public function orHavingRaw($sql, array $bindings = array() )
	{
		$this->havingRaw($sql,  $bindings  , $boolean = 'or');
		return $this;
	}
	
	/**
	 * 
	 * @param string $name
	 * @param string $default
	 * @return string
	 */
	public function getSqlArrayItem( $name , $default = null){
		$item = @$this->sqlArray[$name];
		if( $item == null ){
			return $default;
		}
		return $item;
	}
	public function appendBindings($moreParams){
	    if( !empty( $moreParams)){
	        if( is_array( $moreParams) ){
	           $this->sqlArray["bindings"] = array_merge( $this->sqlArray["bindings"] , $moreParams );
	        }
	        else{
	            $this->sqlArray["bindings"][] = $moreParams;
	        }
	    }
	}
	public function buildJoin(){
	    $joins = $this->sqlArray['join']; //[] = [$table,$condition,$params];
	    $sub_sql = "";
	    for( $i=0;$i<count($joins);$i++ ){
	        $l = $joins[$i];
	        $join = $l[0];
	        $tbl =  $this->config['prefix'].$l[1];
	        $cdt = $l[2];
	        $params = $l[3];
	        $sub_sql .= " ".  $join . "  " . $tbl . " on " . $cdt ;
	        $this->appendBindings( $params );
	    }
	    
	    return $sub_sql;
	}
	/**
	 * $where = [
	 *   [ where , id , =, ?, and ]
	 *   [ whereIn , id, [1,2,3],and ]
	 * ]
	 * @return string
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
				$this->appendBindings( $values );
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
	
	/**
	 * @return string
	 */
	public function buildHaving(){
		$where = $this->getSqlArrayItem('having','' );
		
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
	
	/**
	 * @return string
	 */
	public function toSql(){
		$select =$this->getSqlArrayItem("select","*");
		
		$sql = "select " . $select;
		$table = $this->getSqlArrayItem("table","");
		$sql .= " from " . $this->config['prefix'].$table;
		$sql .= $this->buildJoin();
		
		
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
	
	public function sql(){
	    $o = clone $this;
	    return $o->toSql();
	}
	/*
	public function sqlParams(){
 
	    return $this->sqlArray["bindings"];
	}*/
	/**
	 * @return array
	 */
	public function get(){
		$sql = $this->toSql();
		$data = $this->executeQuery( $sql , $this->sqlArray["bindings"] );
		$this->clearSqlArray();
		return $data;
		
	}
	/**
	 * @return array
	 */
	public function all(){
		
		return $this->get();
	}
	/**
	 * @return array|stdClass
	 */
	public function first(){
		$this->limit(1, 0);
		$rows = $this->get();
		
		return @$rows[0];
	}
	
	/**
	 * 
	 * @param number $perPage
	 * @param int $page
	 * @return Paginator
	 */
	public function paginate($perPage = 15, $page = null)
	{
		$othis = clone $this;
		$total = $othis->count();
		
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
		if( $page <= 0 ){
			$page = 1;
		}
		$offset = ($page-1)*$perPage;
		//echo $this->limit( $perPage, $offset )->toSql();
		$data = $this->limit( $perPage, $offset )->get();
		
		$paginator = new Paginator();
		$paginator->first =1;
		$paginator->last = $pageCount;
		$paginator->page = $page;
		$paginator->size = $perPage;
		$paginator->total = $total;
		$paginator->data = $data;
		return $paginator;
	}
	/**
	 * 
	 * @param string $field
	 * @return int
	 */
	public function count($field = "*"){
		return $this->_function("count",$field );
	}
	/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
	public function max($field = "*"){
		return $this->_function("max",$field );
	}
	/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
	public function min($field = "*"){
		return $this->_function("min",$field );
	}
	/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
	public function sum($field = "*"){
		return $this->_function("sum",$field );
	}
	/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
	public function avg($field = "*"){
		return $this->_function("avg",$field );
	}
	/**
	 * @param string $function sql function name,eg. max,count
	 * @param string $field
	 * @return int|float|double
	 */
	public function _function($function,$field = "*"){
		$this->select( $function.'(' . $field . ') as cnt' );
		$data = $this->get();
		$cnt = @$data[0]->cnt;
		return $cnt;
	}
	/**
	 * @return \PDO
	 */
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
			return $this->pdo = new \PDO($dsn, $this->config['username'], $this->config['password'] ,
						array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '". $this->config['charset'] ."'" ) 
					);
		}
	}
	
	public function getDSN(){
		return "";
	}
	
	/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return array
	 */
	public function executeQuery( $sql ,$params = null ){
		$sth = $this->executeUpdate($sql, $params );
		$data = $sth->fetchAll(static::$fetchStyle);
		//echo $sql;
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
		//echo $sql;
		$sth = $pdo->prepare( $sql );
		$ret = $sth->execute( $params );
		$this->errorInfo($sth,$sql,$params);
		
		self::$sqlHistory[] = [$sql,$params];
		
		return $sth;
	}
	/**
	 * 
	 * @param \PDOStatement $sth
	 */
	public function errorInfo($sth,$sql,$params){
		$e = $sth->errorInfo();
		$msg = "SQL: " .$sql . "\r\n";
		$msg .= "Params: " . var_export( $params,true ) . "\r\n";
		$msg .= "SQLSTATE error code: " . $e[0] . " \r\n";
		$msg .= "Driver-specific error code: " . $e[1] . " \r\n";
		$msg .= "Driver-specific error message: " . $e[2] . " \r\n";
		
		if( $this->config['sql_error_display_method'] == "output" ){
			if( $e[1]>0)
			echo $msg;
		}
	   if( isset( $GLOBALS['db_debug'])){
		    echo $msg;
		}
	}
	
	/**
	 * 
	 * @param array|\stdClass $data
	 * @return int last insert id
	 */
	public function insert( $data ){
		
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
		
		$pdo = $this->getPDO();
		$this->clearSqlArray();
		return $pdo->lastInsertId();
		
	}
	/**
	 * 
	 * @param array|\stdClass $data
	 * @return int affected rows
	 */
	public function update( $data ){
		
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
		
		$values = array_merge( $values, $bindings );
		
		$tableName =$this->config['prefix']. $this->sqlArray["table"] ;
		$sql = "update " . $tableName . " set " .implode(',', $setArr) . $where  ;
		
		$sth = $this->executeUpdate($sql , $values);
		$this->clearSqlArray();
		return $sth->rowCount();
		
	
	}
	
	/**
	 * @return int affected rows
	 */
	public function delete(  ){
		  
		$where = $this->buildWhere();
		$bindings = $this->sqlArray["bindings"];
		 
		$tableName =$this->config['prefix']. $this->sqlArray["table"] ;
		$sql = "delete from " . $tableName . "  "  . $where  ;
	
		$sth = $this->executeUpdate($sql ,$bindings);
		$this->clearSqlArray();
		return $sth->rowCount();
		
	}
	
	protected  function _join( $join_type,$table,$condition,$params = array()){
	    $this->sqlArray['join'][] = [$join_type,$table,$condition,$params];
	}
	
	public function leftJoin($table,$condition,$params = array()){
	   $this->_join('left join', $table, $condition,$params);
	   return $this;
	}
	public function rightJoin($table,$condition,$params = array()){
	    $this->_join('right join', $table, $condition,$params);
	    return $this;
	}
	public function innerJoin($table,$condition,$params = array()){
	    $this->_join('INNER JOIN', $table, $condition,$params);
	    return $this;
	}
	public function outerJoin($table,$condition,$params = array()){
	    $this->_join('OUTER JOIN', $table, $condition,$params);
	    return $this;
	}
	public function naturalJoin($table,$condition,$params = array()){
	    $this->_join('NATURAL JOIN', $table, $condition,$params);
	    return $this;
	}
	
	
}