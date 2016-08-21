<?php
namespace Wudimei\Validator;
class Required  extends RuleValidator{
	 
	public function isValid($required = true){
		if( $required == true ){
			if( trim( $this->value )!= ""){
				return true;
			}
			else {
				return false;
			}
		}
		else{
			return true;
		}
	}
	

}