<?php
namespace Wudimei;

trait DefaultInstance {
	public static $instance;
	
	public static function __callstatic($method, $arguments) {
		if( !isset(static::$instance)){
			self::$instance = static::createDefaultInstance();
		}
		
		return call_user_func_array( [static::$instance,$method],   $arguments);
	}
	
	/**
	 * please override this function while use this trait
	 * 
	 * @return mixed please return an instance
	 */
	public static function createDefaultInstance(){
		 
	}
}