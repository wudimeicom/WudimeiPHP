<?php
namespace Wudimei\StaticProxies;

use Wudimei\StaticProxy;


class View {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\View();	
	}
}