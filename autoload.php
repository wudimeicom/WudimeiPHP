<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
spl_autoload_register(function ($class) {
	
	if( strpos($class,"Wudimei\\") !== false ){
		
		$file = __DIR__ . "/" . str_replace("Wudimei\\","", $class) . ".php";
		if( file_exists( $file ) ){
			 // echo $file . "<br />";
			require_once $file;
		}
	}
	elseif( strpos($class,"\\") === false ){
		
			Wudimei\StaticProxyLoader::load( $class );
		
	}
	
	
});
	 