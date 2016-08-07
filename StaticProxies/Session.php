<?php
namespace Wudimei\StaticProxies;
use Wudimei\StaticProxy;


class Session {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\Session();	
	}
}