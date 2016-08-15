<?php
namespace Wudimei\Validator;
class Minlength extends RuleValidator{
	public function isValid($minlen,$encoding = "UTF-8"){
		$len = mb_strlen( $this->value , $encoding );
		//echo $len;
		if( $len < $minlen ){
			return false;
		}
		else{
			return true;
		}
	}
} 