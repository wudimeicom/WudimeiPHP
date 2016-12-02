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
		$langText = trans('validation.'.$this->ruleName ,$args);
		// var_dump( $langText );
		return $langText;
	}
	
	public function getFieldLabel( $fieldName ){
		$fieldLabel = trans('fieldlabels.'.$fieldName);
		  
		//guest label
		if( $fieldLabel == ''){
		    $ctrl = \Router::controller();
		    $ctrlArr = explode('\\', $ctrl );
		    $cls = $ctrlArr[ count( $ctrlArr)-1];
		    $cls2 = str_replace('Controller', '', $cls ); //remove suffix 'Controller'
		    $cls2 = strtolower( $cls2);
		   $fieldLabel = trans($cls2 .'.'.$fieldName);
		   if( $fieldLabel == ''){ //append suffix 's'
		       $fieldLabel = trans($cls2 .'s.'.$fieldName);
		   }
		   if( $fieldLabel == ''){ //remove suffix 's'
		       $cls3 = substr( $cls2, 0,strlen( $cls2)-1);
		       $fieldLabel = trans($cls3 .'.'.$fieldName);
		   }
		   if( $fieldLabel == ''){
		          $fieldLabel = trans('validation.attributes.'.$fieldName);
		   }
		}
		//end of guest label
		if( $fieldLabel == ''){
			$fieldLabel = $fieldName;
		}
		return $fieldLabel;
	}
	
	public function formatErrorMessage(  ){
		return $this->makeErrorMessage();
	}
}