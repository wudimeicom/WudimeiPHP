<?php
namespace Wudimei\Validator;
class Email  extends RuleValidator{
	 
	public function isValid($emailRequired = true){
		if( $emailRequired == true ){
			if(preg_match("/^([a-zA-Z0-9\.\-\_]+)@([a-zA-Z0-9\-]+)(\.([a-zA-Z]{2,3}))*$/i", $this->value))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else{
			return true;
		}
	}
}