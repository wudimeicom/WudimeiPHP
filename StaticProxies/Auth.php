<?php
namespace Wudimei\StaticProxies;

use Wudimei\StaticProxy;


class Auth {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\Auth();	
	}
}