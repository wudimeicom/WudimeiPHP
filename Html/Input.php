<?php
namespace Wudimei\Html;
use Wudimei\Html\Element;

class Input extends Element {
	function __construct() {
		parent::__construct("input");
	}
	
	public function name($value = null ){
		return $this->attr('name', $value);
	}
	
	public function value( $value =null ){
		return $this->attr('value', $value);
	}
	
}