<?php
namespace Wudimei\DB\StaticProxies;

use Wudimei\StaticProxy;


class Model {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\DB\Model();	
	}
	public static function callstatic($method, $arguments)  {
		if( !isset( self::$instance)){
			self::$instance = static::createObject();
			
		}
		if( !method_exists(self::$instance , $method)){
			$conn = static::$instance->select;
			
			if( method_exists( $conn, $method)){
				return call_user_func_array( [$conn,$method], $arguments);
			}
		}
	
		return call_user_func_array( [static::$instance,$method],   $arguments);
	}
}