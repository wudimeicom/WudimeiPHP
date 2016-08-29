<?php
namespace Wudimei\Validator;

class Alpha_num  extends RuleValidator{

	public function isValid($wantValidation = true){
		if( $wantValidation == true ){
			return preg_match('/^[a-z0-9]+$/i', $this->value) ;
		}
		else{
			return true;
		}
	}
}