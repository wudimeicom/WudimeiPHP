<?php
namespace Wudimei;
class Session{
	public static $session;
	public static function loadConfig( $file ){
		if( file_exists( $file ) ){
			$config = include $file;
			$driver = $config['driver'];
			if( $driver == 'file'){
				$session = new \Wudimei\Session\File($config);
			}
		}
		else{
			throw new \Exception('sesstion config file "' . $file . '" does not exists');
		}
		self::$session = $session;

	}
	
	public static function start(){
		//session_start();
		self::$session->start();
	}
	
	public static function set( $name,$value ){
		return self::$session->set( $name,$value );
	}
	
	public static function get( $name ,$default = null ){
		$value = self::$session->get( $name  );
		if( is_null( $value) || !isset( $value)){
			return $default;
		}
		return $value;
	}
	
	public static function all(){
		//session_start();
		return self::$session->all();
	}
	
	public static function delete( $name ){
		return self::$session->delete( $name );
	}
	
	public static function destroy()
	{
		return self::$session->destroy();
	}
}