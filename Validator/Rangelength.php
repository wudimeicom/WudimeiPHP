<?php
namespace Wudimei\Validator;
class Rangelength  extends RuleValidator{
	 
	public function isValid($min,$max,$encoding="UTF-8"){
		$len = mb_strlen( $this->value, $encoding);
		return $min <= $len && $len <= $max;
	}
}