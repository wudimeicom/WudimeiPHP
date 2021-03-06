<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */

use Wudimei\ArrayHelper;
use Wudimei\Html\CheckBox;
use Wudimei\Html\Radio;


function html_checkboxes( $attrs ){
	$html = "";
	$values = @$attrs['values'];
	$name = $attrs['name'];
	$selected = $attrs['selected'];
	$output = @$attrs['output'];
	$separator = @$attrs['separator'];
	$id_prefix = @$attrs['id_prefix'];
	$options = @$attrs['options'];
	$value_key = @$attrs['value_key'];
	$output_key = @$attrs['output_key'];
	
	if( empty( $selected )){
	    $selected = array();
	    
	}
	
	if( !empty( $options)){
		if( trim( $value_key )!= "" && trim( $output_key) != "" ){
			$values = ArrayHelper::getColumn( $options, $value_key);
			$output = ArrayHelper::getColumn($options, $output_key);
			
		}
		else{
			list($values,$output ) = ArrayHelper::divide( $options);
		}
	}
	$otherAttrs = ArrayHelper::except( $attrs, ['values','name','selected','output','separator','id_prefix','options','value_key','output_key'] );
	 
	for( $i=0; $i< count( $values ); $i++ ){
		$val = $values[$i];
		$checkbox = new CheckBox();
		$checkbox->name($name)->value($val);
		if( in_array( $val, $selected) ){
			$checkbox->checked(true);
		}
		if( $id_prefix != "" ){
			$checkbox->id($id_prefix. $val );
		}
		$checkbox->attr($otherAttrs);
		 
		$html .= $checkbox . $output[$i] . $separator . "\r\n";
	}
	return $html;
}


function html_radios( $attrs ){
	$html = "";
	$values = @$attrs['values'];
	$name = @$attrs['name'];
	$selected = @$attrs['selected'];
	$output = @$attrs['output'];
	$separator = @$attrs['separator'];
	$id_prefix = @$attrs['id_prefix'];
	$options = @$attrs['options'];
	$value_key = @$attrs['value_key'];
	$output_key = @$attrs['output_key'];
	 
	if( !empty( $options)){
		if( trim( $value_key )!= "" && trim( $output_key) != "" ){
			$values = ArrayHelper::getColumn( $options, $value_key);
			$output = ArrayHelper::getColumn($options, $output_key);
			
		}
		else{
			list($values,$output ) = ArrayHelper::divide( $options);
		}
	}
	$otherAttrs = ArrayHelper::except( $attrs, ['values','name','selected','output','separator','id_prefix','options','value_key','output_key'] );
	 
	for( $i=0; $i< count( $values ); $i++ ){
		$val = $values[$i];
		$radio = new Radio();
		$radio->name($name)->value($val);
		if(   $val == $selected  ){
			$radio->checked(true);
		}
		if( $id_prefix != "" ){
			$radio->id( $id_prefix. $val);
		}
		
		$radio->attr( $otherAttrs );
		$html .= $radio . $output[$i] . $separator . "\r\n";
	}
	return $html;
}



function html_select( $attrs ){
	$html = "";
	$values = @$attrs['values'];
	$name = $attrs['name'];
	$selected = $attrs['selected'];
	$output = @$attrs['output'];
	 
	$id_prefix = @$attrs['id_prefix'];
	$options = @$attrs['options'];
	$value_key = @$attrs['value_key'];
	$output_key = @$attrs['output_key'];
	$first_value = @$attrs['first_value'];
	$first_text = @$attrs['first_text'];
	
	if( !is_array( $selected)){
		$selected = array( $selected );
	}
	if( !empty( $options)){
		if( trim( $value_key )!= "" && trim( $output_key) != "" ){
			$values = ArrayHelper::getColumn( $options, $value_key);
			$output = ArrayHelper::getColumn($options, $output_key);
				
		}
		else{
			list($values,$output ) = ArrayHelper::divide( $options);
		}
	}
	if( trim( $first_value) != "" ){
		 array_unshift( $values, $first_value);
		array_unshift( $output, $first_text);
	}
	$otherAttrs = ArrayHelper::except( $attrs, ['values','name','selected','output','id_prefix','options','value_key','output_key','first_text','first_value'] );
	$select = new Wudimei\Html\Select();
	$select->name($name);
	$select->attr($otherAttrs);
	
	for( $i=0; $i< count( $values ); $i++ ){
		$val = $values[$i];
		$text = trans( $output[$i] );
		$option = new Wudimei\Html\Option();
		$option->addChild( $text );
		$option->value($val);
		if( in_array( $val, $selected) ){
			$option->selected(true);
		}
		$select->addChild( $option );
	}
	$html .= $select .   "\r\n";
	return $html;
}
