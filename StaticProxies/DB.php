<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\StaticProxies;

use Wudimei\StaticProxy;


class DB {
	use StaticProxy;
	
	public static function createObject(){
		$db = new \Wudimei\DB();	
		return $db;
	}
	 
	public static function callstatic($method, $arguments)  {
		if( !isset( self::$instance)){
			self::$instance = static::createObject();
			self::callInitMethod();
		}
		if( !method_exists(self::$instance , $method)){
			$conn = static::$instance->connection();
			//print_r( static::$instance->connection() );
			if( method_exists( $conn, $method)){
				return call_user_func_array( [$conn,$method], $arguments);
			}
		}
		
		return call_user_func_array( [static::$instance,$method],   $arguments);
	}
}