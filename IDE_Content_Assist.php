
<?php 
class DB{

public static  function __construct( );
/**
	 * Register a connection with the manager.
	 *
	 * @param  array   $config
	 * @param  string  $name
	 * @return void
	 */
public static  function addConnection( $config,$name = 'default');

public static  function loadConfig( $configFile);
/**
	 * 
	 * @param string $name
	 * @return  \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function connection( $name = 'default');

public static  function clearSqlArray( );
/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function select( $select = '*');
/**
	 * 
	 * @param unknown $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function from( $tableName);
/**
	 * 
	 * @param unknown $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function table( $tableName);
/**
	 * 
	 * @param unknown $limit
	 * @param unknown $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function limit( $limit,$offset);
/**
	 * 
	 * @param unknown $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param unknown $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function groupBy( $field);
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param unknown $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param unknown $name
	 * @param unknown $default
	 * @return string
	 */
public static  function getSqlArrayItem( $name,$default = NULL);
/**
	 * $where = [
	 *   [ where , id , =, ?, and ]
	 *   [ whereIn , id, [1,2,3],and ]
	 * ]
	 * @return string
	 */
public static  function buildWhere( );
/**
	 * @return string
	 */
public static  function buildHaving( );
/**
	 * @return string
	 */
public static  function toSql( );
/**
	 * @return array
	 */
public static  function get( );
/**
	 * @return array
	 */
public static  function all( );
/**
	 * @return array|stdClass
	 */
public static  function first( );
/**
	 * 
	 * @param number $perPage
	 * @param null|int $page
	 * @return Paginator
	 */
public static  function paginate( $perPage = 15,$page = NULL);

public static  function count( $field = '*');

public static  function max( $field = '*');

public static  function min( $field = '*');

public static  function sum( $field = '*');

public static  function avg( $field = '*');

public static  function _function( $function,$field = '*');

public static  function getPDO( );

public static  function getDSN( );

public static  function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public static  function executeUpdate( $sql,$params = NULL);

public static  function insert( $data);

public static  function update( $data);

public static  function delete( );
}
class Model{

public static  function __construct( );

public static  function __call( $name,$args);

public static static  function __callstatic( $method,$args);

public static  function find( $id);

public static  function clearSqlArray( );
/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function select( $select = '*');
/**
	 * 
	 * @param unknown $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function from( $tableName);
/**
	 * 
	 * @param unknown $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function table( $tableName);
/**
	 * 
	 * @param unknown $limit
	 * @param unknown $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function limit( $limit,$offset);
/**
	 * 
	 * @param unknown $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param unknown $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function groupBy( $field);
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param unknown $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param unknown $name
	 * @param unknown $default
	 * @return string
	 */
public static  function getSqlArrayItem( $name,$default = NULL);
/**
	 * $where = [
	 *   [ where , id , =, ?, and ]
	 *   [ whereIn , id, [1,2,3],and ]
	 * ]
	 * @return string
	 */
public static  function buildWhere( );
/**
	 * @return string
	 */
public static  function buildHaving( );
/**
	 * @return string
	 */
public static  function toSql( );
/**
	 * @return array
	 */
public static  function get( );
/**
	 * @return array
	 */
public static  function all( );
/**
	 * @return array|stdClass
	 */
public static  function first( );
/**
	 * 
	 * @param number $perPage
	 * @param null|int $page
	 * @return Paginator
	 */
public static  function paginate( $perPage = 15,$page = NULL);

public static  function count( $field = '*');

public static  function max( $field = '*');

public static  function min( $field = '*');

public static  function sum( $field = '*');

public static  function avg( $field = '*');

public static  function _function( $function,$field = '*');

public static  function getPDO( );

public static  function getDSN( );

public static  function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public static  function executeUpdate( $sql,$params = NULL);

public static  function insert( $data);

public static  function update( $data);

public static  function delete( );

public function clearSqlArray( );
/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function select( $select = '*');
/**
	 * 
	 * @param unknown $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function from( $tableName);
/**
	 * 
	 * @param unknown $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function table( $tableName);
/**
	 * 
	 * @param unknown $limit
	 * @param unknown $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function limit( $limit,$offset);
/**
	 * 
	 * @param unknown $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param unknown $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function groupBy( $field);
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param unknown $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param unknown $field
	 * @param unknown $param2
	 * @param unknown $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param unknown $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param unknown $name
	 * @param unknown $default
	 * @return string
	 */
public function getSqlArrayItem( $name,$default = NULL);
/**
	 * $where = [
	 *   [ where , id , =, ?, and ]
	 *   [ whereIn , id, [1,2,3],and ]
	 * ]
	 * @return string
	 */
public function buildWhere( );
/**
	 * @return string
	 */
public function buildHaving( );
/**
	 * @return string
	 */
public function toSql( );
/**
	 * @return array
	 */
public function get( );
/**
	 * @return array
	 */
public function all( );
/**
	 * @return array|stdClass
	 */
public function first( );
/**
	 * 
	 * @param number $perPage
	 * @param null|int $page
	 * @return Paginator
	 */
public function paginate( $perPage = 15,$page = NULL);

public function count( $field = '*');

public function max( $field = '*');

public function min( $field = '*');

public function sum( $field = '*');

public function avg( $field = '*');

public function _function( $function,$field = '*');

public function getPDO( );

public function getDSN( );

public function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public function executeUpdate( $sql,$params = NULL);

public function insert( $data);

public function update( $data);

public function delete( );
}
class Cache{
/**
	 * 
	 * @param string $file
	 * @throws \Exception
	 */
public static  function loadConfig( $file);
/**
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @param int $lifetime
	 * @return void
	 */
public static  function set( $name,$value,$lifetime = 30);
/**
	 * 
	 * @param string $name
	 * @return mixed
	 */
public static  function get( $name);
/**
	 * 
	 * @param string $name
	 * @return \Wudimei\Cache\File
	 */
public static  function store( $name = '');
}
class Session{

public static  function loadConfig( $file);

public static  function start( );

public static  function set( $name,$value);

public static  function get( $name,$default = NULL);

public static  function all( );

public static  function delete( $name);

public static  function destroy( );
}
