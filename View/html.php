<?php


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
	
	if( !empty( $options)){
		if( trim( $value_key )!= "" && trim( $output_key) != "" ){
			$values = ArrayHelper::getColumn( $options, $value_key);
			$output = ArrayHelper::getColumn($options, $output_key);
			
		}
		else{
			list($values,$output ) = ArrayHelper::divide( $options);
		}
	}
	$otherAttrs = ArrayHelper::except( $attrs, ['values','name','selected','output','separator','id_prefix','options'] );
	 
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
	$otherAttrs = ArrayHelper::except( $attrs, ['values','name','selected','output','separator','id_prefix','options'] );
	 
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