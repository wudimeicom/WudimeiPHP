<?php
namespace Wudimei\Validator;
class Maxlength extends RuleValidator{
	
	public $maxLength;
	
	public function isValid($maxlen,$encoding = "UTF-8"){
		
		$this->maxLength = $maxlen;
		
		$len = mb_strlen( $this->value , $encoding );
		//echo $len;
		if( $len > $maxlen ){
			return false;
		}
		else{
			return true;
		}
	}
	

	public function formatErrorMessage(  ){
		return $this->makeErrorMessage([
				'maxlength' => $this->maxLength
		]);
	}
	
} 