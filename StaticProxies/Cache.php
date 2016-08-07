<?php
namespace Wudimei\StaticProxies;

use Wudimei\StaticProxy;


class Cache {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\Cache();	
	}
}