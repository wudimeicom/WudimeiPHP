<?php
namespace Wudimei;
class Cache{
	public static $config;
	public static function loadConfig( $file ){
		if( file_exists( $file ) ){
			$config = include $file;
			self::$config = $config;
		}
		else{
			throw new \Exception('cache configuration file ' . $file . ' does not exists');
		}
		 
	}
	
	public static function set($name,$value,$lifetime=  30){
		
	}
}