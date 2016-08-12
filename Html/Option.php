<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
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