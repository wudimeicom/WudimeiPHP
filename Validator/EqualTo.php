<?php
namespace Wudimei\Validator;

class EqualTo extends RuleValidator{
	
	
	public $fieldName2;
	public function isValid($fieldName){
		$this->fieldName2 = $fieldName;
		
		$val1 = $this->data[ $this->fieldName ];
		$val2 = $this->data[ $fieldName ];
		//echo $val1; echo " " . $val2;
		if( $val1 == $val2 ){
			return true;
		}
		else{
			return false;
		}
	}
	

	public function formatErrorMessage(  ){
		$msgArray = [
			'field2' => $this->getFieldLabel( $this->fieldName2 )
		];
		return $this->makeErrorMessage($msgArray);
	}
}