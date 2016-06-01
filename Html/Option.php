<?php
namespace Wudimei\Html;
use Wudimei\Html\Element;

class Option extends Element {
	function __construct() {
		parent::__construct( "option" );
	}
	

	public function selected( $isSelected = null ){
		if( $isSelected === null ){
			return $this->attr('selected');
		}
		else{
			if( $isSelected === true ){
				$this->attr('selected','selected');
			}
		}
		return $this;
	}
	
	public function value( $value =null ){
		return $this->attr('value', $value);
	}
}