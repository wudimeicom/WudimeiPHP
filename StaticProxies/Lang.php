<?php

namespace Wudimei\StaticProxies;
use Wudimei\StaticProxy;


class Lang {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\Lang();	
	}
}