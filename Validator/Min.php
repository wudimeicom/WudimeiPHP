<?php
namespace Wudimei\Validator;
class Min  extends RuleValidator{
	
	public $min;
	public function isValid($minValue){
		$this->min = $minValue;
		
		return $this->value>= $minValue;
	}
	

	public function formatErrorMessage(  ){
		return $this->makeErrorMessage(['min' => $this->min]);
	}
}