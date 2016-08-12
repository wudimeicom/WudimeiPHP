<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\Html;
use Wudimei\Html\Element;

class Select extends Element {
	function __construct() {
		parent::__construct( "select" );
	}
	
	public function name($value = null ){
		return $this->attr('name', $value);
	}
}