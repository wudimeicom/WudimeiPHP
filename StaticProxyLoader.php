<?php 
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class StaticProxyLoader{

	public static $alias;
	public static function loadConfig($configFile){
		 $aliasArray = include $configFile;
		 //print_r( $aliasArray );
		 self::$alias = $aliasArray;
	}
	
	public static function load( $aliasName ){
		if(isset( self::$alias[ $aliasName] )){
			$item = self::$alias[ $aliasName];
			$fullClassName = $item['class'];
			//var_dump( $aliasName ); 
			//var_dump( $fullClassName );
			
			class_alias($fullClassName , $aliasName );
		}
	}
}