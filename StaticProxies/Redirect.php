<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\StaticProxies;

use Wudimei\StaticProxy;


class Redirect {
	use StaticProxy;
	
	public static function createObject(){
		return new \Wudimei\Redirect();	
	}
}