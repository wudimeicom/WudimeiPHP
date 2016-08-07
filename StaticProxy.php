<?php
namespace Wudimei;

trait StaticProxy {
	public static $instance;
	
	public static function callstatic($method, $arguments) {
		if( !isset( self::$instance)){
			self::$instance = static::createObject();
		}
		if( !method_exists(self::$instance , $method)){
			throw new \Exception(__CLASS__ . " donot have method '" . $method . "'");
			 
		}
		
		return call_user_func_array( [static::$instance,$method],   $arguments);
	}
	
	public static function __callstatic($method, $arguments) {
		return static::callstatic($method, $arguments);
	}
	
	/**
	 * please override this function while use this trait
	 * 
	 * @return mixed please return an instance
	 */
	public static function createObject(){
		 
	}
}