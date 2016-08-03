<?php
namespace Wudimei;
class Lang{
	public static $locale;
	public static $path;
	public static $langs = array();
	
	public static function setPath( $path2 ){
		self::$path = $path2;
	}
	
	public static function  setLocale( $locale ){
		self::$locale = $locale;
	}
	
	public static function load($group){
		$file = self::$path . "/" . self::$locale . "/" . $group . ".php";
		$langs2 = include $file;
		if( !empty( $langs2)){
			self::$langs = array_merge( self::$langs,$langs2);
		}
	}
	
	public static function  get( $name, $args = array() ){
		$lang = ArrayHelper::fetch( self::$langs, $name );
		if( !empty( $args ) ){
			foreach ( $args as $k => $v ){
				$lang = str_replace(":" . $k, $v, $lang );
			}
		}
		return $lang;
	}
}