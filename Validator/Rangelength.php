<?php
namespace Wudimei\Validator;
class Rangelength  extends RuleValidator{
	public $min;
	public $max;
	public function isValid($min,$max,$encoding="UTF-8"){
		$this->min = $min;
		$this->max = $max;
		
		$len = mb_strlen( $this->value, $encoding);
		return $min <= $len && $len <= $max;
	}
	

	public function formatErrorMessage(  ){
		return $this->makeErrorMessage(['min' => $this->min, 'max' => $this->max ]);
	}
}