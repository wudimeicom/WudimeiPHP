<?php
namespace Wudimei\StaticProxies;

class Menu{
	use \Wudimei\StaticProxy;
	public static function createObject(){
		return new \Wudimei\Menu();
	}
}