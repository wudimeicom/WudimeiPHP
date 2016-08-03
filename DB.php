<?php
namespace Wudimei;
use Wudimei\DB\Query\PDO_MYSQL;
class DB{
	
	protected  static $connections;
	protected  static $configs;
	
	use DefaultInstance;
	public function __construct(){
		
	}
	
	/**
	 * Register a connection with the manager.
	 *
	 * @param  array   $config
	 * @param  string  $name
	 * @return void
	 */
	public static function addConnection(array $config, $name = 'default')
	{
		static::$configs[$name] = $config;
	}
	
	public static function loadConfig( $configFile ){
		$cfg = include( $configFile );
		$connections = $cfg['connections'];
		$def = $cfg['default'];
		foreach ( $connections as $key => $item ){
			$name = $key;
			if( $key == $def ){
				$name = "default";
			}
			self::addConnection($item , $name );
		}
	}
	/**
	 * 
	 * @param string $name
	 * @return  \Wudimei\DB\Query\PDO_Abstract
	 */
	public static function connection( $name = 'default' ){
		if( isset( static::$connections[$name] )){
			return static::$connections[$name];
		}
		else{
			$cfg = static::$configs[$name];
			//print_r( $cfg );
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
			return static::$connections[$name] = $conn;
			
		}
	}
	
	/**
	 * @return PDO_MYSQL
	 */
	public static function createDefaultInstance(){
		
		return self::connection();
	}
}
