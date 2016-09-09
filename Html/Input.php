<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\Html;
use Wudimei\Html\Element;

class Input extends Element {
	function __construct(  ) {
		parent::__construct("input");
		$this->isEmptyElementTag = true;
	}
	
	public function name($value = null ){
		return $this->attr('name', $value);
	}
	
	public function value( $value =null ){
		return $this->attr('value', $value);
	}
	
	public function type( $value =null ){
		return $this->attr('type', $value);
	} 
	
}