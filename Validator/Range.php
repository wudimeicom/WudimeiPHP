<?php
namespace Wudimei\Validator;
class Range  extends RuleValidator{
	
	public $min;
	public $max;
	
	public function isValid($min,$max){
		$this->min = $min;
		$this->max = $max;
		
		return $min <= $this->value && $this->value <= $max;
	}
	

	public function formatErrorMessage(  ){
		return $this->makeErrorMessage([
				'min' => $this->min,
				'max' => $this->max
		]);
	}
}