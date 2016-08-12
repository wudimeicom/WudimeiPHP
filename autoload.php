<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
spl_autoload_register(function ($class) {
	 
	if( strpos($class,"Wudimei\\") == 0 ){
		$file = __DIR__ . "/" . str_replace("Wudimei\\","", $class) . ".php";
		if( file_exists( $file ) ){
			require_once $file;
		}
	}
	
});
	 