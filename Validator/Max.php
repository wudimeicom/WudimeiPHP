<?php
namespace Wudimei\Validator;
class Max  extends RuleValidator{
	
	
	public $max;
	public function isValid($maxValue){
		$this->max = $maxValue;
		
		return $this->value<= $maxValue;
	}
	

	public function formatErrorMessage(  ){
		return $this->makeErrorMessage([
				'max' => $this->max
		]);
	}
}