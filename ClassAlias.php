<?php 
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class ClassAlias{

	public static function loadConfig($configFile){
		 $aliasArray = include $configFile;
		 foreach ( $aliasArray as $k => $v ){
		 	class_alias( $v, $k );
		 }
	}
}