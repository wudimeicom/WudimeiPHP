<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
use Wudimei\StaticProxyLoader;

trait StaticProxy {
	public static $instance;
	
	public static function callstatic($method, $arguments) {
		if( !isset( self::$instance)){
			self::$instance = static::createObject();
			self::callInitMethod();
			
		}
		if( !method_exists(self::$instance , $method)){
			//throw new \Exception( get_class(self::$instance) . " does not have method '" . $method . "'");
			 
		}
		
		return call_user_func_array( [static::$instance,$method],   $arguments);
	}
	
	public static function __callstatic($method, $arguments) {
		return static::callstatic($method, $arguments);
	}
	
	public static function callInitMethod(){
		$classArr = explode("\\",  __CLASS__ );
		$className = $classArr[ count( $classArr) -1 ];
		$classInfo = @StaticProxyLoader::$alias[ $className ];
			
		if( isset($classInfo['init_method']) && trim( $classInfo['init_method']) != ""){
		
			call_user_func_array([self::$instance, $classInfo['init_method']], $classInfo['args'] );
		}
	}
	/**
	 * please override this function while use this trait
	 * 
	 * @return mixed please return an instance
	 */
	public static function createObject(){
		 
	}
}