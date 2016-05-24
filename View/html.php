<?php


use Wudimei\ArrayHelper;

function html_checkboxes( $attrs ){
	$html = "";
	$values = $attrs['values'];
	$name = $attrs['name'];
	$selected = $attrs['selected'];
	$output = $attrs['output'];
	$separator = @$attrs['separator'];
	$id_prefix = @$attrs['id_prefix'];
	
	$otherAttrs = ArrayHelper::except( $attrs, ['values','name','selected','output','separator','id_prefix'] );
	//print_r( $otherAttrs );
	for( $i=0; $i< count( $values ); $i++ ){
		$val = $values[$i];
		$html .= "<input type=\"checkbox\" name=\"" . $name."\" value=\"" . $val ."\" " ;
		if( in_array( $val, $selected) ){
			$html .= " checked=\"checked\" ";
		}
		if( $id_prefix != "" ){
			$html .= " id=\"".$id_prefix. $val."\" ";
		}
		if( !empty($otherAttrs) ){
			foreach ( $otherAttrs as $k => $v ){
				$html .= " " . $k . "=\"" . $v . "\" ";
			}
		}
		$html .= " />  " . $output[$i] . $separator . "\r\n";
	}
	return $html;
}