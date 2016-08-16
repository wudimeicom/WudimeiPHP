<?php

/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
use Validator;

class Validator {
	public $errors = [ ];
	public function __construct() {
		
	}
	
	public function validate($array, $rules, $messages = []) {
		\Lang::load('validation');
		$success = true;
		foreach ( $rules as $fieldName => $ruleItems ) {
			
			//$ruleItems = $rules [$fieldName];
			if( is_string( $ruleItems )){
				$ruleItems = $this->parseRule( $ruleItems );
			}
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
	public function parseRule( $rules ){
		$result = array();
		$ruleArr = preg_split('/[;\|]/i', $rules );
		//print_r( $ruleArr );
		for( $i=0;$i< count( $ruleArr); $i++ ){
			$ruleItem = $ruleArr[$i];
			$ruleItemArr = preg_split('/[:]/i', $ruleItem );
			//print_r( $ruleItemArr );
			$ruleName = trim($ruleItemArr[0]);
			$params = array();
			if( isset( $ruleItemArr[1] )){
				$params = preg_split('/[,]/i', $ruleItemArr[1] );
				for( $j=0; $j< count( $params); $j++ ){
					$params[$j] = trim( $params[$j] );
				}
			}
			//print_r( $params );
			$result[ $ruleName] = $params;
		}
		return $result;
	}
	public function addError($fieldName, $ruleName, $messages) {
		$msg = "";
		
		$fieldLabel = \Lang::get('fieldlabels.'.$fieldName);
		//var_dump( $fieldLabel );
		if( $fieldLabel == ''){
			$fieldLabel = $fieldName;
		}
		$langText = \Lang::get('validation.'.$ruleName ,['field' => $fieldLabel]);
		//var_dump( $langText );
		
		if (isset ( $messages [$fieldName] )) {
			$msg = $messages [$fieldName];
		}
		elseif (isset ( $messages [$fieldName . "." . $ruleName] )) {
			$msg = $messages [$fieldName . "." . $ruleName];
		}
		elseif( isset($langText)){
			$msg = $langText;
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