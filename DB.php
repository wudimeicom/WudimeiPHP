<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
use Wudimei\DB\Query\PDO_MYSQL;
class DB{
	/**
	 * 
	 * @var array
	 */
	protected   $connections;
	protected   $configs;
	
	
	public function __construct(){
		
	}
	
	/**
	 * Register a connection with the manager.
	 *
	 * @param  array   $config
	 * @param  string  $name
	 * @return void
	 */
	public  function addConnection(array $config, $name = 'default')
	{
		$this->configs[$name] = $config;
		 
	}
	
	public  function loadConfig( $configFile ){
		$cfg = include( $configFile );
		$connections = $cfg['connections'];
		$def = $cfg['default'];
		foreach ( $connections as $key => $item ){
			$name = $key;
			if( $key == $def ){
				$name = "default";
			}
			$this->addConnection($item , $name );
		}
	}
	/**
	 * 
	 * @param string $name
	 * @return  \Wudimei\DB\Query\PDO_Abstract
	 */
	public  function connection( $name = 'default' ){
		if( isset( $this->connections[$name] )){
			return $this->connections[$name];
		}
		else{
			$cfg = $this->configs[$name];
			
			$driver = $cfg['driver'];
			$conn = null;
			if( $driver == "PDO_MYSQL"){
				$conn = new PDO_MYSQL( $cfg );
			}
			else{
				$className1 = "Wudimei\\DB\\Query\\" . $driver;
				if( class_exists( $className1)){
					$conn = new $className1( $cfg );
				}
				elseif( class_exists( $driver )){
					$conn = new $driver( $cfg );
				}
			} 
			return $this->connections[$name] = $conn;
			
		}
	}
	
	public function __call( $method, $args ){
		$conn = $this->connection();
		return call_user_func_array( [$conn,$method], $args );
	}
}
