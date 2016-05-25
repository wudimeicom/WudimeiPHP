<?php
namespace Wudimei\Html;
use Wudimei\Html\Element;

class Radio extends Input {
	function __construct() {
		parent::__construct( );
		$this->attrs([
				'type' => "radio"
		]);
	}
	

	public function checked( $isChecked = null ){
		if( $isChecked === null ){
			return $this->attr('checked');
		}
		else{
			if( $isChecked === true ){
				$this->attr('checked','checked');
			}
		}
		return $this;
	}
}