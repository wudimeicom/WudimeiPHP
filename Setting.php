<?php

namespace Wudimei;

use Wudimei\Html\Input;
use Wudimei\Html\Textarea;

class Setting{
	
	public function buildControl( $settingItem ){
		$html = "a";
		//print_r( $settingItem);
		$name = $settingItem->name;
		$value = $settingItem->value;
		$type = $settingItem->type;
		$properties = json_decode( $settingItem->properties , true ,null, JSON_UNESCAPED_UNICODE );
		//print_r( $properties);
		if( $value == ""){
			$value = $properties['default'];
			unset( $properties['default']);
		}
		
		$control = null;
		if( $type == "text" )
		{
			$control = new Input();
			$control->name( $name)->type("text");
			if( !is_null($value) && $value != ""){
				$control->value( $value);
			}
		}
		if( $type == "password"){
			$control = new Input();
			$control->name( $name)->type("password");
			if( !is_null($value) && $value != ""){
				$control->value( $value);
			}
		}
		if( $type == "textarea"){
			$control = new Textarea();
			$control->name( $name)->children(" ");
		}
		
		if( !empty($properties) && !is_null($control)){
			foreach ($properties as $k => $v ){
				if( !is_null( $v) && $v != ""){
					$control->attr( $k,$v);
				}
			}
		}
		$html = $control;
		return $html;
	}
}