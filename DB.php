<?php
namespace Wudimei;
use Wudimei\DB\Query\PDO_MYSQL;
class DB{
	
	protected  static $connections;
	protected  static $configs;
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
}