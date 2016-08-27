<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 * @deprecated
 */
namespace Wudimei\Html;

class Document{
	public function load_from_string( $string ){
		$ps = new DocumentParser();
		$ps->parse($string);
	}
	
}