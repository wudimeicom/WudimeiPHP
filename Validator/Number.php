<?php

namespace Wudimei\Validator;
class Number  extends RuleValidator{
	 
	public function isValid($wantNumber = true){
		if( $wantNumber == true ){
			return is_numeric( $this->value );
		}
		else{
			return true;
		}
	}
	

}