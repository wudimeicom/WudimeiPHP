<?php

namespace Wudimei\StaticProxies;
use Wudimei\StaticProxy;


class Router {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\Router();	
	}
}