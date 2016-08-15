<?php
namespace Wudimei\Validator;
class Maxlength extends RuleValidator{
	public function isValid($maxlen,$encoding = "UTF-8"){
		$len = mb_strlen( $this->value , $encoding );
		//echo $len;
		if( $len > $maxlen ){
			return false;
		}
		else{
			return true;
		}
	}
} 