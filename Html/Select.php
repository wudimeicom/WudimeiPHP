<?php
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