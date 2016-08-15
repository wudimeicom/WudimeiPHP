<?php
namespace Wudimei\Validator;
class Range  extends RuleValidator{
	 
	public function isValid($min,$max){
		return $min <= $this->value && $this->value <= $max;
	}
}