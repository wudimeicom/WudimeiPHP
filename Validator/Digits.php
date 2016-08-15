<?php
namespace Wudimei\Validator;
class Digits  extends RuleValidator{
	 
	public function isValid($digits = true){
		if( $digits == true ){
			return preg_match('/^[0-9]+$/i', $this->value) ;
		}
		else{
			return true;
		}
	}
}