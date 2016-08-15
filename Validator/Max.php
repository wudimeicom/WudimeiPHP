<?php
namespace Wudimei\Validator;
class Max  extends RuleValidator{
	 
	public function isValid($maxValue){
		return $this->value<= $maxValue;
	}
}