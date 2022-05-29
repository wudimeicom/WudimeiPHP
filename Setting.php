<?php

namespace Wudimei;

use Wudimei\Html\Input;
use Wudimei\Html\Textarea;
use Wudimei\Html\Radio;
use Wudimei\Html\Span;
use Wudimei\Html\CheckBox;
use Wudimei\Html\Select;
use Wudimei\Html\Option;
 
class Setting{
	
	public $save_path;
	public $data;
	
	public function loadConfig( $file ){
		$cfg = include $file;
		$this->save_path = $cfg['save_path'];
	}
	
	public function storeToFile(){
		$data = \DB::select('name,value')->from('settings')->get();
		$dt = ArrayHelper::toAssoc( $data, 'name', 'value');
		$cnt = '<' .'?php return '. var_export( $dt , true ) . '; ?' .'>';
		file_put_contents( $this->save_path, $cnt );
	}
	
	public function get( $name ){
		if( !isset( $this->data )){
			$this->data = include $this->save_path;
		}
		return @$this->data[$name];
	}
	
	public function buildControl( $settingItem ){
		$html = "";
		//print_r( $settingItem);
		$name = $settingItem->name;
		$name = "data[" . $settingItem->id . "]";
		$value = $settingItem->value;
		$type = $settingItem->type;
		$properties = json_decode( $settingItem->properties , true   );
		//print_r( $properties);
		
		//print_r( $settingItem->properties );
		if( $value == ""){
			$value = $properties['default'];
			
		}
		unset( $properties['default']);
		
		$control = null;
		if( $type == "text" )
		{
			$control = new Input();
			$control->name( $name)->type("text");
			if( !is_null($value) && $value != ""){
				$control->value( $value);
			}
		}
		elseif( $type == "password"){
			$control = new Input();
			$control->name( $name)->type("password");
			if( !is_null($value) && $value != ""){
				$control->value( $value);
			}
		}
		elseif( $type == "textarea"){
			$control = new Textarea();
			$control->name( $name)->value( $value);
		}
		elseif( $type == "radios"){
			$opts = @$properties['options'];
			
			$control = new Span();
			if( !empty( $opts)){
				foreach( $opts as $opt ){
					$radio = new Radio();
					 
					$radio->name($name)->value( $opt['value'] );
					if( $opt['value'] == $value ){
						$radio->checked(true);
					}
					 $control->addChild( $radio );
					 $control->addChild( \Lang::get( $opt['text']) ." " );
				}
			}
			unset($properties['options']);
		}
		elseif( $type == 'checkboxes' ){
			$opts = @$properties['options'];
			
			if( is_string( $value )){
				$value = explode(",", $value);
			}
			$control = new Span();
			$name .= "[]";
			if( !empty( $opts)){
				foreach( $opts as $opt ){
					$radio = new CheckBox();
			
					$radio->name($name)->value( $opt['value'] );
					if( array_search( $opt['value'] ,$value ) !== false ){
						$radio->checked(true);
					}
					$control->addChild( $radio );
					$control->addChild( \Lang::get( $opt['text']) . " " );
				}
			}
			unset($properties['options']);
		}
		elseif( $type == "select"){
			$opts = @$properties['options'];
				
			if( is_string( $value )){
				$value = explode(",", $value);
			}
			$control = new Select();
			if( isset( $properties['multiple'])){
				$name .= '[]';
			}
			$control->name($name);
			if( !empty( $opts)){
				foreach( $opts as $opt ){
					$optItem = new Option();
					$optItem->value(  $opt['value']  );
					if( array_search( $opt['value'] ,$value ) !== false ){
						$optItem->attr("selected" ,"selected");
					}
					$optItem->addChild( \Lang::get( $opt['text'])  );
					$control->addChild( $optItem );
				}
			}
			unset($properties['options']);
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