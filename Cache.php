<?php
namespace Wudimei;
class Cache{
	public static $config;
	public static $instances;
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
		return self::store()->set($name,$value,$lifetime);
	}
	
	public static function get( $name ){
		return self::store()->get( $name );
	}
	
	public static function store( $name = ""){
		if( $name == "" ){
			$name = self::$config['default'];
		}
		if( isset( self::$instances[$name] ) ){
			return self::$instances[$name];
		}
		else{
			$cfg = self::$config['stores'][$name];
			$cfg['prefix'] = self::$config['prefix'];
			$driver = $cfg['driver'];
			$obj = null;
			if( $driver == 'file' ){
				$obj = new \Wudimei\Cache\File($cfg);
			}
			else{
				$driverCls = ucfirst( $driver);
				$buildinDriverCls = '\\Wudimei\\Cache\\' . $driverCls;
				$userDriverCls = '\\' . $driverCls;
				if( class_exists( $buildinDriverCls ) ){
					$obj = new $buildinDriverCls( $cfg );
				}
				elseif( class_exists($userDriverCls)){
					$obj = new $userDriverCls( $cfg );
				}
			}
			return self::$instances[$name] = $obj;
		}
	}
}