<?php 
namespace Wudimei;
class ClassAlias{

	public static function withStaticProxies(){
		class_alias("Wudimei\\StaticProxies\\DB", 'DB' );
		class_alias("Wudimei\\StaticProxies\\Cache", 'Cache' );
		class_alias("Wudimei\\StaticProxies\\Session", 'Session' );
		class_alias("Wudimei\\StaticProxies\\View", 'View' );
		class_alias("Wudimei\\StaticProxies\\Router", 'Router' );
		class_alias("Wudimei\\StaticProxies\\Lang", 'Lang' );
		class_alias("Wudimei\\StaticProxies\\Auth", 'Auth' );
		
	}
}