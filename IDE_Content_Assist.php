
<?php 
namespace Wudimei{ 
class DB{
/**
	 * 
	 * @var array
	 */
protected $connections ; 

protected $configs ; 

public function __construct( );
/**
	 * Register a connection with the manager.
	 *
	 * @param  array   $config
	 * @param  string  $name
	 * @return void
	 */
public function addConnection( $config,$name = 'default');

public function loadConfig( $configFile);
/**
	 * 
	 * @param string $name
	 * @return  \Wudimei\DB\Query\PDO_Abstract
	 */
public function connection( $name = 'default');

public function __call( $method,$args);

public function clearSqlArray( );
/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function select( $select = '*');
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function from( $tableName);
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function table( $tableName);
/**
	 * 
	 * @param int $limit
	 * @param int $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function limit( $limit,$offset);
/**
	 * 
	 * @param string $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param string $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function groupBy( $field);
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $name
	 * @param string $default
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
	 * @param int $page
	 * @return Paginator
	 */
public function paginate( $perPage = 15,$page = NULL);
/**
	 * 
	 * @param string $field
	 * @return int
	 */
public function count( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function max( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function min( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function sum( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function avg( $field = '*');
/**
	 * @param string $function sql function name,eg. max,count
	 * @param string $field
	 * @return int|float|double
	 */
public function _function( $function,$field = '*');
/**
	 * @return \PDO
	 */
public function getPDO( );

public function getDSN( );
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return array
	 */
public function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public function executeUpdate( $sql,$params = NULL);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int last insert id
	 */
public function insert( $data);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int affected rows
	 */
public function update( $data);
/**
	 * @return int affected rows
	 */
public function delete( );
}
}
namespace { 
class DB{
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

public static  function __call( $method,$args);

public static  function clearSqlArray( );
/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function select( $select = '*');
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function from( $tableName);
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function table( $tableName);
/**
	 * 
	 * @param int $limit
	 * @param int $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function limit( $limit,$offset);
/**
	 * 
	 * @param string $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param string $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function groupBy( $field);
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $name
	 * @param string $default
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
	 * @param int $page
	 * @return Paginator
	 */
public static  function paginate( $perPage = 15,$page = NULL);
/**
	 * 
	 * @param string $field
	 * @return int
	 */
public static  function count( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function max( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function min( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function sum( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function avg( $field = '*');
/**
	 * @param string $function sql function name,eg. max,count
	 * @param string $field
	 * @return int|float|double
	 */
public static  function _function( $function,$field = '*');
/**
	 * @return \PDO
	 */
public static  function getPDO( );

public static  function getDSN( );
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return array
	 */
public static  function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public static  function executeUpdate( $sql,$params = NULL);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int last insert id
	 */
public static  function insert( $data);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int affected rows
	 */
public static  function update( $data);
/**
	 * @return int affected rows
	 */
public static  function delete( );
}
}
namespace { 
class Model{

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
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function from( $tableName);
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function table( $tableName);
/**
	 * 
	 * @param int $limit
	 * @param int $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function limit( $limit,$offset);
/**
	 * 
	 * @param string $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param string $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function groupBy( $field);
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public static  function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $name
	 * @param string $default
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
	 * @param int $page
	 * @return Paginator
	 */
public static  function paginate( $perPage = 15,$page = NULL);
/**
	 * 
	 * @param string $field
	 * @return int
	 */
public static  function count( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function max( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function min( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function sum( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public static  function avg( $field = '*');
/**
	 * @param string $function sql function name,eg. max,count
	 * @param string $field
	 * @return int|float|double
	 */
public static  function _function( $function,$field = '*');
/**
	 * @return \PDO
	 */
public static  function getPDO( );

public static  function getDSN( );
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return array
	 */
public static  function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public static  function executeUpdate( $sql,$params = NULL);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int last insert id
	 */
public static  function insert( $data);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int affected rows
	 */
public static  function update( $data);
/**
	 * @return int affected rows
	 */
public static  function delete( );
}
}
namespace Wudimei\DB{ 
class Model{

public $table ; 

public $primaryKey ; 

public $connection ; 
/**
	 * 
	 * @var PDO_MYSQL
	 */
public $select ; 

public function __call( $name,$args);

public static function __callstatic( $method,$args);

public function find( $id);

public function clearSqlArray( );
/**
	 * 
	 * @param string $select
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function select( $select = '*');
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function from( $tableName);
/**
	 * 
	 * @param string $tableName
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function table( $tableName);
/**
	 * 
	 * @param int $limit
	 * @param int $offset
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function limit( $limit,$offset);
/**
	 * 
	 * @param string $field
	 * @param string $direction
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orderBy( $field,$direction = 'asc');
/**
	 * 
	 * @param string $field
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function groupBy( $field);
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function where( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhere( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function whereRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhereRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function whereIn( $field,$values = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param array $values
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orWhereIn( $field,$values = array (
));
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function having( $field,$param2,$param3 = NULL,$boolean = 'and');
/**
	 * 
	 * @param string $field
	 * @param string $param2
	 * @param string $param3
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orHaving( $field,$param2,$param3 = NULL);
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @param string $boolean
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function havingRaw( $sql,$bindings = array (
),$boolean = 'and');
/**
	 * 
	 * @param string $sql
	 * @param array $bindings
	 * @return \Wudimei\DB\Query\PDO_Abstract
	 */
public function orHavingRaw( $sql,$bindings = array (
));
/**
	 * 
	 * @param string $name
	 * @param string $default
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
	 * @param int $page
	 * @return Paginator
	 */
public function paginate( $perPage = 15,$page = NULL);
/**
	 * 
	 * @param string $field
	 * @return int
	 */
public function count( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function max( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function min( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function sum( $field = '*');
/**
	 *
	 * @param string $field
	 * @return int|float|double
	 */
public function avg( $field = '*');
/**
	 * @param string $function sql function name,eg. max,count
	 * @param string $field
	 * @return int|float|double
	 */
public function _function( $function,$field = '*');
/**
	 * @return \PDO
	 */
public function getPDO( );

public function getDSN( );
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return array
	 */
public function executeQuery( $sql,$params = NULL);
/**
	 * 
	 * @param unknown $sql
	 * @param unknown $params
	 * @return PDOStatement
	 */
public function executeUpdate( $sql,$params = NULL);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int last insert id
	 */
public function insert( $data);
/**
	 * 
	 * @param array|\stdClass $data
	 * @return int affected rows
	 */
public function update( $data);
/**
	 * @return int affected rows
	 */
public function delete( );
}
}
namespace { 
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
}
namespace { 
class Session{
/**
	 * load config array from file
	 * @param string $file
	 * @throws \Exception
	 * @return void
	 */
public static  function loadConfig( $file);
/**
	 * session start
	 * @return void
	 */
public static  function start( );
/**
	 * set data to session from name $name
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
public static  function set( $name,$value);
/**
	 * get session item value by $name,if null then return the $default
	 * @param string $name
	 * @param mixed $default
	 * @return mixed
	 */
public static  function get( $name,$default = NULL);
/**
	 * get all session
	 */
public static  function all( );
/**
	 * delete the sesion item by name
	 * @param string $name
	 * @return bool
	 */
public static  function delete( $name);
/**
	 * remove all session data,empty it!
	 */
public static  function destroy( );
}
}
namespace { 
class View{
/**
	 * load config array into View from file 
	 * @param string $file config file name
	 * @return void
	 */
public static  function loadConfig( $file);
/**
	 * 
	 * @param string $viewName view's name,eg default.article.index
	 * @param array $vars
	 * @return string 
	 */
public static  function make( $viewName,$vars);
/**
	 * 
	 * @param string $viewName view's name,eg default.article.index
	 * @return string return the dest view's relative path
	 */
public static  function compile( $viewName);
/**
	 * 
	 * @param bool $bool
	 * @return void
	 */
public static  function setForceCompile( $bool = true);
}
}
