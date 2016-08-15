<?php
namespace Wudimei\Validator;

class EqualTo extends RuleValidator{
	public function isValid($fieldName){
		$val1 = $this->data[ $this->fieldName ];
		$val2 = $this->data[ $fieldName ];
		//echo $val1; echo " " . $val2;
		if( $val1 == $val2 ){
			return true;
		}
		else{
			return false;
		}
	}
}