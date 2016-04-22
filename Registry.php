<?php

namespace Wudimei;
class Registry extends \ArrayObject{
	
	private static $_instance;
	
	public static function getInstance(){
		if(self::$_instance !==null){
			return self::$_instance;
		} else {
			return self::$_instance = new  Registry();
		}
	}
	
	
	
	public static function set($index,$value){
		$obj = self::getInstance();
		$obj->offsetSet($index, $value);
	}
	
	public static function get($index){
		$obj = self::getInstance();
		$value = @$obj->offsetGet($index);
		return $value;
	}
	
	public static function has($index){
		$obj = self::getInstance();
		$has = $obj->has($index);
		return $has;
	}
	
	
}