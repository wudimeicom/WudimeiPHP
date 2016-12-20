<?php 
namespace { 
trait not_static_db{

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

public function appendBindings( $moreParams);

public function buildJoin( );
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

public function sql( );
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
	 * @param \PDOStatement $sth
	 */
public function errorInfo( $sth,$sql,$params);
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

protected function _join( $join_type,$table,$condition,$params = array (
));

public function leftJoin( $table,$condition,$params = array (
));

public function rightJoin( $table,$condition,$params = array (
));

public function innerJoin( $table,$condition,$params = array (
));

public function outerJoin( $table,$condition,$params = array (
));

public function naturalJoin( $table,$condition,$params = array (
));
}
}
namespace { 
trait static_db{

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

public static  function appendBindings( $moreParams);

public static  function buildJoin( );
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

public static  function sql( );
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
	 * @param \PDOStatement $sth
	 */
public static  function errorInfo( $sth,$sql,$params);
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

protected static  function _join( $join_type,$table,$condition,$params = array (
));

public static  function leftJoin( $table,$condition,$params = array (
));

public static  function rightJoin( $table,$condition,$params = array (
));

public static  function innerJoin( $table,$condition,$params = array (
));

public static  function outerJoin( $table,$condition,$params = array (
));

public static  function naturalJoin( $table,$condition,$params = array (
));
}
}
namespace Wudimei\DB\Query{ 
class PDO_Abstract{
use not_static_db;}
}
namespace Wudimei{ 
class DB{
use not_static_db;/**
	 * 
	 * @var array
	 */
protected $connections ; 

protected $configs ; 

protected $config_loaded ; 
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
}
}
namespace { 
class DB{
use static_db;/**
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
}
}
namespace { 
class Model{
use static_db;
public static  function __call( $name,$args);

public static static  function __callstatic( $method,$args);

public static  function _find( $id);
}
}
namespace Wudimei\DB{ 
class Model{
use not_static_db,static_db;
public $table ; 

public $primaryKey ; 

public $connection ; 
/**
	 * 
	 * @var PDO_MYSQL
	 */
public $select ; 

public static  function __call( $name,$args);

public static static  function __callstatic( $method,$args);

public static  function _find( $id);

public static  function __call( $name,$args);

public static static  function __callstatic( $method,$args);

public static  function _find( $id);
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
	 * remove all session data,empty it!
	 */
public static  function __call( $name,$args);
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

public static  function getForceCompile( );

public static  function setSkipCommentTags( $bool = true);

public static  function getSkipCommentTags( );
}
}
namespace { 
class Auth{

public static  function loadConfig( $configFile);

public static  function setConfigItem( $key,$value);

public static  function getConfigItem( $key);

public static  function setTokenLifeTime( $seconds);
/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
public static  function check( );

public static  function user( );

public static  function logout( );

public static  function setUser( $user);

public static  function attempt( $kvArray,$remember = false);
}
}
namespace { 
class Lang{
/**
	 * 
	 * @param string $configFile
	 */
public static  function loadConfig( $configFile);
/**
	 * 
	 * @param string $path2
	 */
public static  function setPath( $path2);
/**
	 * 
	 * @param string $locale
	 */
public static  function setLocale( $locale);
/**
	 * 
	 * @param string $group
	 * @param bool $reload
	 * @return void
	 */
public static  function load( $group,$reload = false);
/**
	 * 
	 * @param string $group
	 */
public static  function reload( $group);
/**
	 * 
	 * @param string $name
	 * @param array $args
	 */
public static  function get( $name,$args = array (
));
/**
	 * 
	 * @param string $name
	 * @param string $value
	 */
public static  function set( $name,$value);

public static  function transAll( $var);
/**
	 * 
	 * @param string $groupName
	 * @param array $value
	 */
public static  function groupUpdate( $groupName,$value);
/**
	 * append a group or array to the group
	 * @param string $groupName
	 * @param string|array $groupName2OrArray
	 * @param bool $replace
	 */
public static  function groupAppend( $groupName,$groupName2OrArray,$replace = true);
}
}
namespace { 
class Router{

public static  function loadConfig( $routeFile);

public static  function handle( );

public static  function parseRoute( $expr);

public static  function controller( );

public static  function action( );
}
}
namespace { 
class Request{

public static  function method( );

public static  function isMethod( $method);

public static  function isPost( );

public static  function isGet( );

public static  function isPut( );

public static  function isHead( );

public static  function isDelete( );

public static  function get( $key,$default = NULL);

public static  function post( $key,$default = NULL);

public static  function item( $key,$default = NULL);

public static  function getInt( $key,$default = 0);

public static  function getFloat( $key,$default = 0);

public static  function getDouble( $key,$default = 0);

public static  function all( );
}
}
namespace { 
class Validator{
/**
	 * 
	 * @param array $array
	 * @param array $rules
	 * @param array $messages
	 */
public static  function validate( $array,$rules,$messages = array (
),$attributes = array (
));
/**
	 * 
	 * @param string $rules
	 */
public static  function parseRule( $rules);
/**
	 * 
	 * @param string $fieldName
	 * @param string $ruleName
	 * @param array $messages
	 * @param RuleValidator $ruleValidator
	 */
public static  function addError( $fieldName,$ruleName,$messages,$ruleValidator);

public static  function setError( $fieldName,$errorMessage);
/**
	 * get error array
	 * @return array errors
	 */
public static  function getErrors( );

public static  function prepareFieldLabels( $langGroupName);
}
}
namespace { 
class Redirect{

public static  function to( $url);

public static  function back( );

public static  function with( $key,$value);

public static  function withErrors( $errors = array (
),$key = 'default');

public static  function withSuccess( $message);

public static  function withWarning( $message);

public static  function withInfo( $message);

public static  function withDanger( $message);
}
}
namespace { 
class XSS{

public static  function clean( $htmlStr);

private static  function wantRemove( $nodeName);

public static  function cleanDeep( $arr);
}
}
namespace { 
class Setting{

public static  function loadConfig( $file);

public static  function storeToFile( );

public static  function get( $name);

public static  function buildControl( $settingItem);
}
}
namespace { 
class Config{

public static  function setDir( $dir);

public static  function get( $keys);

public static  function load( $sectionName);

public static  function set( $keys,$value);
}
}
namespace { 
class Route{

public static  function getRoutes( );

public static  function get( $url,$callback);

public static  function post( $url,$callback);

public static  function put( $url,$callback);

public static  function delete( $url,$callback);

public static  function any( $url,$callback);

public static  function match( $verbs,$url,$callback);

public static  function add( $verbs,$url,$callback);

public static  function group( $setting,$closure);

public static  function getPrefix( );

public static  function getNamespace( );
}
}
namespace { 
class Security{

public static  function check( $perm);
}
}
namespace { 
class Mail{

public static  function loadConfig( $configFile);

public static  function __call( $method,$args);

public static  function send( );

public static  function to( $to);

public static  function cc( $cc);

public static  function bcc( $bcc);

public static  function subject( $subject);

public static  function content( $content);

public static  function contentType( $contentType);

public static  function debug( $debug);

public static  function setProperties( $cfg);

public static  function getEmailAddressArray( $address);
/**
	 * pending array("name"=>"","email"=>"")
	 * @var type string
	 */
public static  function formatEmailAddresses( $address);
}
}
