<?php
namespace Wudimei\Validator;
class Minlength extends RuleValidator{
	
	public $minLength;
	
	public function isValid($minlen,$encoding = "UTF-8"){
		$this->minLength = $minlen;
		
		$len = mb_strlen( $this->value , $encoding );
		//echo $len;
		if( $len < $minlen ){
			return false;
		}
		else{
			return true;
		}
	}
	

	public function formatErrorMessage(  ){
		return $this->makeErrorMessage(['minlength'=> $this->minLength]);
	}
} 