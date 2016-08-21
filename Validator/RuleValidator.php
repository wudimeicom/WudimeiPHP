<?php
namespace Wudimei\Validator;

class RuleValidator{
	public $value;
	public $data;
	public $fieldName;
	public $ruleName;
	
	public function makeErrorMessage( $args =[]){
		$fieldLabel = $this->getFieldLabel( $this->fieldName);
		$args['field'] = $fieldLabel;
		$langText = \Lang::get('validation.'.$this->ruleName ,$args);
		// var_dump( $langText );
		return $langText;
	}
	
	public function getFieldLabel( $fieldName ){
		$fieldLabel = \Lang::get('fieldlabels.'.$fieldName);
		//var_dump( $fieldLabel );
		if( $fieldLabel == ''){
			$fieldLabel = $fieldName;
		}
		return $fieldLabel;
	}
	
	public function formatErrorMessage(  ){
		return $this->makeErrorMessage();
	}
}