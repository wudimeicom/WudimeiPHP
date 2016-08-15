<?php

/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

class Validator {
	public $errors = [ ];
	public function __construct() {
	}
	
	public function validate($array, $rules, $messages = []) {
		$success = true;
		foreach ( $rules as $fieldName => $ruleItems ) {
			
			//$ruleItems = $rules [$fieldName];
			$value = @$array[$fieldName];
			foreach ( $ruleItems as $ruleName => $ruleValue ) {
				if (is_array ( $ruleValue ) == false) {
					$ruleValue = [ 
							$ruleValue 
					];
				}
				$ruleClassName = ucfirst ( strtolower ( $ruleName ) );
				$class = "\\Wudimei\\Validator\\" . $ruleClassName;
				if (class_exists ( $class ) == false) {
					$class = $ruleClassName;
				}
				
				$obj = new $class ();
				$obj->value = $value;
				$obj->fieldName = $fieldName;
				$obj->data = &$array;
				$result = call_user_func_array ( [ 
						$obj,
						'isValid' 
				], $ruleValue );
				if ($result == false) {
					$success = false;
					$this->addError ( $fieldName, $ruleName, $messages );
				}
				
			}
		}
		return $success;
	}
	
	public function addError($fieldName, $ruleName, $messages) {
		$msg = "";
		
		if (isset ( $messages [$fieldName] )) {
			$msg = $messages [$fieldName];
		}
		if (isset ( $messages [$fieldName . "." . $ruleName] )) {
			$msg = $messages [$fieldName . "." . $ruleName];
		}
		if (! isset ( $this->errors [$fieldName] )) {
			$this->errors [$fieldName] = '';
		}
		$this->errors [$fieldName] .= $msg;
	}
	
	public function getErrors(){
			return $this->errors;
	}
	
}