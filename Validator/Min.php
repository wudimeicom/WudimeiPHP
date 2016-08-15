<?php
namespace Wudimei\Validator;
class Min  extends RuleValidator{
	 
	public function isValid($minValue){
		return $this->value>= $minValue;
	}
}