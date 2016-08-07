<?php 
namespace Wudimei;
class ClassAlias{

	public static function withStaticProxies(){
		class_alias("Wudimei\\StaticProxies\\DB", 'DB' );
		class_alias("Wudimei\\StaticProxies\\Cache", 'Cache' );
		class_alias("Wudimei\\StaticProxies\\Session", 'Session' );
		
	}
}