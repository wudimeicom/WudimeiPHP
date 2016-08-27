<?php 
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
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
		class_alias("Wudimei\\StaticProxies\\Request", 'Request' );
		class_alias("Wudimei\\StaticProxies\\Redirect", 'Redirect' );
		class_alias("Wudimei\\StaticProxies\\Validator", 'Validator' );
		class_alias("Wudimei\\StaticProxies\\XSS", 'XSS' );
	}
}