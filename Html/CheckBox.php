<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\Html;

class CheckBox extends Input {
	function __construct() {
		parent::__construct();
		$this->attrs([
				'type' => "checkbox"
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